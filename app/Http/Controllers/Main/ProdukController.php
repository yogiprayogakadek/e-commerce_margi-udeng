<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProdukAtributRequest;
use App\Http\Requests\ProdukRequest;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    private function searchForSize($size, $array)
    {
        foreach($array as $key => $value) {
            if($value['size'] === $size) {
                return $key;
            }
        }
        return null;
    }

    private function unggahFotoDetailProduk($request, $nama)
    {
        $fileExtension = $request->file('foto')->getClientOriginalExtension();
        $fileNameStore = str_replace(' ', '_',$nama) . '-' . time() . '.' . $fileExtension;

        $savePath = 'assets/main/uploads/produk/'.str_replace(' ', '', $nama);

        if (!file_exists($savePath)) {
            mkdir($savePath, 666, true);
        }

        $request->file('foto')->move($savePath, $fileNameStore);

        return $savePath . '/' . $fileNameStore;
    }

    private function unggahFotoProduk($request)
    {
        $fileExtension = $request->file('foto')->getClientOriginalExtension();
        $fileNameStore = str_replace(' ', '_',$request->nama) . '.' . $fileExtension;

        $savePath = 'assets/main/uploads/produk';

        if (!file_exists($savePath)) {
            mkdir($savePath, 666, true);
        }

        $request->file('foto')->move($savePath, $fileNameStore);

        return $savePath . '/' . $fileNameStore;
    }

    public function index()
    {
        return view('backend.produk.index');
    }

    public function render()
    {
        $kategori = Kategori::where('status', true)->pluck('id')->toArray();
        $produk = Produk::whereIn('kategori_id', $kategori)->get();

        $view = [
            'data' => view('backend.produk.render', compact('produk'))->render()
        ];

        return response()->json($view);
    }

    public function create()
    {
        $kategori = Kategori::where('status', true)->pluck('nama', 'id')->prepend('Pilih kategori', '')->toArray();

        $view = [
            'data' => view('backend.produk.create', compact('kategori'))->render()
        ];

        return response()->json($view);
    }

    public function store(ProdukRequest $request)
    {
        try {
            $data = [
                'kategori_id' => $request->kategori,
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
            ];

            $produk = Produk::where('nama', $request->nama)->first();

            if(!$produk) {
                if($request->hasFile('foto')) {
                    $data['foto'] = $this->unggahFotoProduk($request);
                }

                Produk::create($data);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Produk berhasil disimpan',
                    'title' => 'Berhasil'
                ]);
            }
            return response()->json([
                'status' => 'info',
                'message' => 'Data sudah ada',
                'title' => 'Info'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                // 'message' => 'Terjadi kesalahan',
                'title' => 'Gagal'
            ]);
        }
    }

    public function edit($id)
    {
        $produk = Produk::find($id);
        $kategori = Kategori::where('status', true)->pluck('nama', 'id')->prepend('Pilih kategori', '')->toArray();
        $view = [
            'data' => view('backend.produk.edit', compact('produk', 'kategori'))->render()
        ];

        return response()->json($view);
    }

    public function update(ProdukRequest $request)
    {
        try {
            $data = [
                'kategori_id' => $request->kategori,
                'nama' => $request->nama,
                'status' => $request->status,
                'deskripsi' => $request->deskripsi,
            ];

            $produk = Produk::find($request->id);

            if($request->nama !== $produk->nama) {
                $uniqueData = !Produk::where('nama', $request->nama)->exists();

                if($uniqueData) {
                    if($request->hasFile('foto')) {
                        unlink($produk->foto);
                        $data['foto'] = $this->unggahFotoProduk($request);
                    }
                    $produk->update($data);
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Produk berhasil di ubah',
                        'title' => 'Berhasil'
                    ]);
                } else {
                    return response()->json([
                        'status' => 'info',
                        'message' => 'Data sudah ada',
                        'title' => 'Info'
                    ]);
                }
            } else {
                if($request->hasFile('foto')) {
                    unlink($produk->foto);
                    $data['foto'] = $this->unggahFotoProduk($request);
                }
                $produk->update($data);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Produk berhasil di ubah',
                    'title' => 'Berhasil'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                // 'message' => 'Terjadi kesalahan',
                'title' => 'Gagal'
            ]);
        }
    }

    public function dataRender($produk_id)
    {
        $produk = Produk::find($produk_id);
        $view = [
            'data' => view('backend.produk.data.render', compact('produk'))->render()
        ];

        return response()->json($view);
    }

    public function dataCreate($produk_id)
    {
        $produk = Produk::find($produk_id);
        if(in_array($produk->kategori->nama, ['Udeng', 'Saputan', 'Kamen'])) {
            $size = [
                'All Size'
            ];
        } elseif ($produk->kategori->nama == 'Sandal') {
            $size = [];
            for($i = 35; $i <= 43; $i++) {
                array_push($size,''. strval($i));
            }
        } elseif ($produk->kategori->nama == 'Baju') {
            $size = [
                'S', 'M', 'L', 'XL'
            ];
        }

        array_unshift($size, '');

        $view = [
            'data' => view('backend.produk.data.create', compact('size', 'produk'))->render()
        ];

        return response()->json($view);
    }

    public function dataStore(ProdukAtributRequest $request)
    {
        try {
            $produk = Produk::find($request->produk_id);
            $payload = json_decode($produk->data, true);
            if($produk->data == null) {
                $data[] = [
                    'size' => $request->size,
                    'stok' => $request->stok,
                    'harga' => preg_replace('/[^0-9]/', '', $request->harga),
                    'status' => true
                ];
                if($request->hasFile('foto')) {
                    $data[0]['foto'] = $this->unggahFotoDetailProduk($request, $produk->nama);
                }
                $payload = json_encode($data);
                $produk->update([
                    'data' => $payload
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Data berhasil disimpan',
                    'title' => 'Berhasil'
                ]);
            } else {
                if($this->searchForSize($request->size, $payload) !== null) {
                    return response()->json([
                        'status' => 'info',
                        'message' => 'Data dengan size "' . $request->size . '" sudah ada!',
                        'title' => 'Info'
                    ]);
                } else {
                    $data = [
                        'size' => $request->size,
                        'stok' => $request->stok,
                        'harga' => preg_replace('/[^0-9]/', '', $request->harga),
                        'status' => true
                    ];
                    $data['foto'] = $this->unggahFotoDetailProduk($request, $produk->nama);
                    array_push($payload, $data);
                    $produk->update([
                        'data' => $payload
                    ]);

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Data berhasil disimpan',
                        'title' => 'Berhasil'
                    ]);
                }

            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                // 'message' => 'Terjadi kesalahan',
                'title' => 'Gagal'
            ]);
        }
    }

    public function dataEdit(Request $request)
    {
        $produk = Produk::find($request->produk_id);
        $key = [$this->searchForSize($request->size, json_decode($produk->data, true))][0];
        $data = json_decode($produk->data, true)[$key];

        $view = [
            'data' => view('backend.produk.data.edit', compact('produk', 'data'))->render()
        ];

        return response()->json($view);
    }

    public function dataUpdate(ProdukAtributRequest $request)
    {
        try {
            $produk = Produk::find($request->produk_id);
            $key = [$this->searchForSize($request->size, json_decode($produk->data, true))][0];
            $payload = json_decode($produk->data, true);
            $data = [
                'size' => $request->size,
                'stok' => $request->stok,
                'harga' => preg_replace('/[^0-9]/', '', $request->harga),
                'status' => $request->status
            ];
            if($request->hasFile('foto')) {
                // unlink($payload['foto']);
                $data['foto'] = $this->unggahFotoDetailProduk($request, $produk->nama);
            } else {
                $data['foto'] = $payload[$key]['foto'];
            }

            $payload[$key] = $data;
            $produk->update([
                'data' => json_encode($payload)
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                // 'message' => 'Terjadi kesalahan',
                'title' => 'Gagal'
            ]);
        }
    }

    public function dataDelete(Request $request)
    {
        // dd($request->all());
        try {
            $produk = Produk::find($request->produk_id);
            $key = [$this->searchForSize($request->size, json_decode($produk->data, true))][0];
            $payload = json_decode($produk->data, true);

            unset($payload[$key]);

            $produk->update([
                'data' => json_encode($payload)
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                // 'message' => 'Terjadi kesalahan',
                'title' => 'Gagal'
            ]);
        }
    }

    public function print()
    {
        $produk = Produk::all();

        $view = [
            'data' => view('backend.produk.print', compact('produk'))->render(),
        ];

        return response()->json($view);
    }
}

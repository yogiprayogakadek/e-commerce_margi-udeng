<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    private function searchBySize($array, $search)
    {
        foreach ($array as $key => $value) {
            if ($value['size'] === $search) {
                return $key;
            }
        }
        return null;
    }

    public function index()
    {
        $produk = Produk::where('status', true)
            ->where('data', '!=', null)
            ->paginate(2);

        $allPrices = collect();

        $produk->each(function ($item) use ($allPrices) {
            $data = json_decode($item->data, true);
            $harga = collect($data)->pluck('harga');
            $allPrices = $allPrices->merge($harga);

            $item->harga_terendah = $harga->min();
            $item->harga_tertinggi = $harga->max();
        });

        if(request()->ajax()) {
            return response()->json([
                'html' => view('landing.pagination.index', compact('produk'))->render(),
                'pagination' => (string) $produk->links(),
            ]);
        }


        return view('landing.index', compact('produk'));
    }

    public function byCategory($kategori_id)
    {
        $produk = Produk::where('status', true)
            ->where('data', '!=', null)
            ->when($kategori_id != 'all', function($query) use($kategori_id) {
                return $query->where('kategori_id', $kategori_id);
            })
            ->paginate(2);

        $allPrices = collect();

        $produk->each(function ($item) use ($allPrices) {
            $data = json_decode($item->data, true);
            $harga = collect($data)->pluck('harga');
            $allPrices = $allPrices->merge($harga);

            $item->harga_terendah = $harga->min();
            $item->harga_tertinggi = $harga->max();
        });


        if(request()->ajax()) {
            return response()->json([
                'html' => view('landing.pagination.index', compact('produk'))->render(),
                'pagination' => (string) $produk->links(),
            ]);
        }


        return view('landing.index', compact('produk'));
    }

    public function detailProduk($produk_id)
    {
        $produk = Produk::find($produk_id);
        $size = [];
        $harga = [];
        $foto = [
            $produk->foto
        ];


        $payload = json_decode($produk->data, true);
        foreach ($payload as $key => $value) {
            $foto[] = $value['foto'];
            $size[] = $value['size'];
            $harga[] = $value['harga'];
        }

        $data = [
            'foto' => $foto,
            'size' => $size,
            'harga' => $harga,
            'produk' => $produk
        ];
        return response()->json($data);
    }

    public function post($produk_id)
    {
        $produk = Produk::findOrFail($produk_id);
        $size = [];
        $harga = [];
        $foto = [
            $produk->foto
        ];

        $payload = json_decode($produk->data, true);
        foreach ($payload as $key => $value) {
            $foto[] = $value['foto'];
            $size[] = $value['size'];
            $harga[] = $value['harga'];
        }

        $data = [
            'foto' => $foto,
            'size' => $size,
            'harga' => $harga,
            'produk' => $produk
        ];
        return view('landing.post.index', compact('data'));
    }

    public function postBySize(Request $request)
    {
        $produk = Produk::find($request->produk_id);
        $payload = json_decode($produk->data, true);

        $stok = $payload[$this->searchBySize($payload, $request->size)]['stok'];
        $harga = $payload[$this->searchBySize($payload, $request->size)]['harga'];

        $data = [
            'stok' => $stok,
            'harga' => toRupiah($harga)
        ];

        return response()->json($data);
    }
}

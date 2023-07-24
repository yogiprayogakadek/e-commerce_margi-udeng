<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    private function searchBySize($array, $search)
    {
        foreach($array as $key => $value) {
            if($value['size'] === $search) {
                return $key;
            }
        }
        return null;
    }

    public function index()
    {
        $produk = Produk::where('status', true)->where('data', '!=', null)->get();
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
        foreach($payload as $key => $value) {
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
        $produk = Produk::find($produk_id);
        $size = [];
        $harga = [];
        $foto = [
            $produk->foto
        ];

        $payload = json_decode($produk->data, true);
        foreach($payload as $key => $value) {
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

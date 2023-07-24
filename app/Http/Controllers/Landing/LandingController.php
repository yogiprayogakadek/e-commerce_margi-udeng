<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;

class LandingController extends Controller
{
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
}

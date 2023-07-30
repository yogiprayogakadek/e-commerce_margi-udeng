<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function index()
    {
        return view('landing.shop-cart.index');
    }

    public function removeItem($id)
    {
        $user = auth()->user()->id;
        \Cart::session($user)->remove($id);

        $view = [
            'data' => view('landing.shop-cart.render')->render()
        ];
        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil dihapus dari keranjang',
            'title' => 'Berhasil',
            'cartTotal' => count(cart()),
            'render' => $view
        ]);
    }
}

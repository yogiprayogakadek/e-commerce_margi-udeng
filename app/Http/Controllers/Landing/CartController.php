<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
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

    public function render()
    {
        $view = [
            'data' => view('landing.templates.partials.cart')->with([
                'cart' => (Auth::check() == true ? cart() : [])
            ])->render()
        ];

        return response()->json($view);
    }

    public function addToCart(Request $request)
    {
        try {
            $produk = Produk::find($request->produk_id);
            $payload = json_decode($produk->data, true);
            $key = $this->searchBySize($payload, $request->size);
            $user_id = Auth::user()->id;
            $cart_id = $produk->id . '-' . str_replace(' ', '', $payload[$key]['size']);

            if(\Cart::session($user_id)->get($cart_id)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Produk sudah ada di keranjang',
                    'title' => 'Gagal',
                ]);
            } else {
                // check stok produk jika lebih dari stock yang tersedia maka
                if ($request->qty > $payload[$key]['stok']) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Stok yang tersedia untuk produk ini adalah ' . $payload[$key]['stok'] . ' item',
                        'title' => 'Gagal',
                    ]);
                } else {
                    \Cart::session($user_id)->add([
                        'id' => $cart_id,
                        'name' => $produk->nama,
                        'price' => $payload[$key]['harga'],
                        'quantity' => $request->qty,
                        'attributes' => [
                            'size' => $request->size,
                            'foto' => $payload[$key]['foto']
                        ],
                        'associatedModel' => $produk
                    ]);

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Produk berhasil ditambahkan ke keranjang',
                        'title' => 'Berhasil',
                        'cartTotal' => count(cart())
                    ]);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'title' => 'Gagal',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function remove($id)
    {
        $user = auth()->user()->id;
        \Cart::session($user)->remove($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil dihapus dari keranjang',
            'title' => 'Berhasil',
            'cartTotal' => count(cart())
        ]);
    }

    public function detail($user_id)
    {
        // \Cart::session($user_id)->clear();
        // $cart_id = $user_id . '-' . 2 . '-' . 'S';
        $cart = \Cart::session($user_id);
        dd($cart->getSubTotal());
    }
}

<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\DetailOrder;
use App\Models\Order;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShoppingCartController extends Controller
{
    public function __construct()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
    }

    protected function order_code() {
        return 'trans-' . bin2hex(random_bytes(6));
    }

    private function searchArea($array, $key, $search)
    {
        $data = array();
        foreach($array as $index => $value) {
            if($value[$key] == $search) {
                $data[] += $index;
            }
        }

        return $data;
    }

    private function openJsonFile($filename)
    {
        $file = \File::json(public_path('assets/list-of-area/'.$filename.'.json'));

        return $file;
    }


    public function index()
    {
    //     $provinces = $this->openJsonFile('provinces');
    //     $province_id = $provinces[$this->searchArea($provinces, "name", strtoupper("nusa tenggara barat"))];

        $file = $this->openJsonFile('regencies');
        $regencies = $this->searchArea($file, "province_id", 52);
        //dd($file[282]);
        $data = array();
        foreach($regencies as $key => $r) {
            if($key <= 2) {
                $data[] = $file[$r];
            } else {
                break;
            }
        }
        return view('landing.shop-cart.index')->with([
            'data' => $data
        ]);
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

    public function checkout(Request $request)
    {
        try {
            DB::beginTransaction();

            // Insert to order table
            $order = Order::create([
                'order_code' => $this->order_code(),
                'user_id' => Auth::user()->id,
                'alamat' => json_encode([
                    'kabupaten' => 'Lombok Barat',
                    'kecamatan' => 'Lombok'
                ]),
            ]);

            // insert into detail order
            foreach (cart() as $key => $value) {
                DetailOrder::create([
                    'order_id' => $order->id,
                    'produk_id' => $value->associatedModel['id'],
                    'size' => $value->attributes['size'],
                    'kuantitas' => $value->quantity
                ]);
            }

            // insert into pembayaran
            Pembayaran::create([
                'order_id' => $order->id,
                'total' => \Cart::session(Auth::user()->id)->getSubtotal(),
                'status' => 'Unpaid',
                // 'payment_payload' => '',
            ]);

            // Return midtrans payload
            $midtransToken = [
                'transaction_details' => [
                    'order_id' => $order->id,
                    'gross_amount' => \Cart::session(Auth::user()->id)->getSubTotal(),
                ],
                'customer_details'  => [
                    'first_name' => Auth::user()->customer->nama,
                    'last_name' => '',
                    'email'      => Auth::user()->email,
                    'phone'       => Auth::user()->customer->telp
                ],
            ];
            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Waiting',
                'title' => 'Berhasil',
                'midtransToken' => \Midtrans\Snap::getSnapToken($midtransToken)
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);

        if($hashed == $request->signature_key) {
            if($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $payment = Pembayaran::where('order_id', $request->order_id);
                $payment->update([
                    'status' => 'Paid',
                    'payment_payload' => json_encode($request->all())
                ]);
            }
        }
    }
}

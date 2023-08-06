<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\DetailOrder;
use App\Models\Order;
use App\Models\Pembayaran;
use App\Models\Produk;
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

    private function searchBySize($array, $search)
    {
        foreach($array as $key => $value) {
            if($value['size'] === $search) {
                return $key;
            }
        }
        return null;
    }

    private function openJsonFile($filename)
    {
        $file = \File::json(public_path('assets/list-of-area/'.$filename.'.json'));

        return $file;
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
                    'provinsi' => $request->provinsi,
                    'kabupaten' => $request->kabupaten,
                    'kecamatan' => $request->kecamatan,
                    'desa' => $request->desa,
                    'kode_pos' => $request->kode_pos,
                    'alamat' => $request->alamat,
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

    public function paymentChecking(Request $request)
    {
        try {
            if($request->status_code == 200) {
                // update order status
                $order = Order::where('id', $request->order_id);
                $order->update([
                    'status' => 'Success'
                ]);

                foreach(cart() as $c) {
                    $produk = Produk::find($c->associatedModel['id']);
                    $payload = json_decode($produk->data, true);
                    $key = $this->searchBySize($payload, $c->attributes['size']);
                    $payload[$key]['stok'] = $payload[$key]['stok'] - $c->quantity;
                    $produk->update([
                        'data' => json_encode($payload)
                    ]);
                }

                // clear all shopping cart
                \Cart::session(Auth::user()->id)->clear();
            }
            $view = [
                'data' => view('landing.shop-cart.render')->render()
            ];
            return response()->json([
                'status' => 'success',
                'message' => 'Pembayaran berhasil',
                'title' => 'Berhasil',
                'cartTotal' => count(cart()),
                'render' => $view
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }

    public function searchRegencies($province_id) {
        $file = $this->openJsonFile('regencies');
        $data = $this->searchArea($file, 'province_id', $province_id);
        $regencies = [];

        foreach($data as $key => $regency) {
            $regencies[] = [
                'id' => $file[$regency]['id'],
                'name' => $file[$regency]['name'],
            ];
        }

        return response()->json($regencies);
    }

    public function searchDistricts($regency_id) {
        $file = $this->openJsonFile('districts');
        $data = $this->searchArea($file, 'regency_id', $regency_id);
        $districts = [];

        foreach($data as $key => $district) {
            $districts[] = [
                'id' => $file[$district]['id'],
                'name' => $file[$district]['name'],
            ];
        }

        return response()->json($districts);
    }

    public function searchVillages($district_id) {
        $file = $this->openJsonFile('villages');
        $data = $this->searchArea($file, 'district_id', $district_id);
        $villages = [];

        foreach($data as $key => $village) {
            $villages[] = [
                'id' => $file[$village]['id'],
                'name' => $file[$village]['name'],
            ];
        }

        return response()->json($villages);
    }


    public function index()
    {
        $file = $this->openJsonFile('provinces');
        $provinces = [];
        foreach($file as $key => $province) {
            $provinces[] = [
                'id' => $province['id'],
                'name' => $province['name'],
            ];
        }
        return view('landing.shop-cart.index')->with([
            'provinces' => $provinces
        ]);
    }
}

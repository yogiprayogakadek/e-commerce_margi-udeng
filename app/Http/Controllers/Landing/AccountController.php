<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\DetailOrder;
use App\Models\Pembayaran;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
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
        return view('landing.account.index');
    }

    public function detailOrder($order_id)
    {
        $detailOrder = DetailOrder::where('order_id', $order_id)->get();

        $data = [];
        $total = 0;
        foreach ($detailOrder as $key => $detail) {
            $produk = Produk::where('id', $detail->produk_id)->first();
            $payload = json_decode($produk->data, true);
            $key = $this->searchBySize($payload, $detail->size);

            array_push(
                $data,
                [
                    'nama'  => $produk->nama,
                    'harga' => toRupiah($payload[$key]['harga']),
                    'size' => $payload[$key]['size'],
                    'kuantitas'   => $detail->kuantitas . ' pcs',
                    'subtotal' => toRupiah($payload[$key]['harga'] * $detail->kuantitas)
                ]
            );

            $total += $payload[$key]['harga'] * $detail->kuantitas;
        }

        return response()->json([
            'data' => $data,
            'total' => toRupiah($total)
        ]);
    }

    public function update(AccountRequest $request)
    {
        try {
            $user = User::where('id', auth()->user()->id)->first();

            // update user email
            $user->update([
                'email' => $request->email
            ]);

            // update customer table
            $user->customer->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
            ]);

            return redirect()->back()->with([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }

    public function updatePassword(PasswordRequest $request)
    {
        try {
            $user = User::where('id', auth()->user()->id)->first();

            if ($request->current_password != '') {
                if (!password_verify($request->current_password, $user->password)) {
                    return redirect()->back()->with([
                        'status' => 'error',
                        'message' => 'Password lama tidak sesuai',
                        'title' => 'Gagal'
                    ]);
                }

                // Update password baru jika sudah benar
                $user->update([
                    'password' => bcrypt($request->new_password)
                ]);
            }

            return redirect()->back()->with([
                'status' => 'success',
                'message' => 'Data berhasil disimpan',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'status' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }

    public function payment(Request $request)
    {
        $payment = Pembayaran::where('id', $request->payment_id)->first();

        $midtransToken = [
            'transaction_details' => [
                'order_id' => $payment->order_id,
                'gross_amount' => $payment->total,
            ],
            'customer_details'  => [
                'first_name' => Auth::user()->customer->nama,
                'last_name' => '',
                'email'      => Auth::user()->email,
                'phone'       => Auth::user()->customer->telp
            ],
        ];

        return response()->json([
            'status' => 'success',
            'midtransToken' => \Midtrans\Snap::getSnapToken($midtransToken)
        ]);
    }
}

<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.dashboard.index');
    }

    public function chartByKategori(Request $request)
    {
        if($request->kategori == 'Kategori') {
            $sum = 'kategori.nama as nama_kategori, SUM(detail_order.kuantitas) as jumlah_transaksi';
        } else {
            $sum = 'kategori.nama as nama_kategori, SUM(pembayaran.total) as jumlah_transaksi';
        }

        $data = DB::table('detail_order')
                    ->selectRaw($sum)
                    ->join('produk', 'produk.id', 'detail_order.produk_id')
                    ->join('kategori', 'kategori.id', 'produk.kategori_id')
                    ->join('order', 'order.id', 'detail_order.order_id')
                    ->join('pembayaran', 'pembayaran.order_id', 'order.id')
                    ->whereBetween('order.created_at', [$request->awal, $request->akhir])
                    ->where('kategori.status', true)
                    ->where('pembayaran.status', 'Paid')
                    // ->when(auth()->user()->role == 'Distributor', function($query) {
                    //     return $query->where('transaksi.distributor_id', auth()->user()->distributor->id);
                    // })
                    ->groupBy('kategori.id')
                    ->get();

        return response()->json($data);
    }
}

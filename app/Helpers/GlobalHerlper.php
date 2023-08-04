<?php

use App\Models\Order;
use App\Models\Pembayaran;

function toRupiah($data) {
    return 'Rp' . number_format($data, 0, '.','.');
}

function cart()
{
    return \Cart::session(auth()->user()->id)->getContent();
}

function cartSubTotal()
{
    $cart = \Cart::session(auth()->user()->id);
    return toRupiah($cart->getSubTotal());
}

function totalOrder()
{
    $order = Order::where('user_id', auth()->user()->id)->where('status', 'Success')->count();

    return $order;
}

function totalBelanja()
{
    $order = Order::where('user_id', auth()->user()->id)->where('status', 'Success')->pluck('id');

    $pembayaran = Pembayaran::whereIn('order_id', $order)->where('status', 'Paid')->sum('total');

    return toRupiah($pembayaran);
}

function orderByUser()
{
    $order = Order::with('pembayaran')->where('user_id', auth()->user()->id)->get();

    return $order;
}

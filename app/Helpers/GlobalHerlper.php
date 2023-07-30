<?php

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

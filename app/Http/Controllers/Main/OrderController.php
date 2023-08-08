<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('backend.order.index');
    }

    public function render()
    {
        $order = Order::all();

        $view = [
            'data' => view('backend.order.render', compact('order'))->render()
        ];

        return response()->json($view);
    }

    public function print()
    {
        $order = Order::with('detail')->get();

        $view = [
            'data' => view('backend.order.print', compact('order'))->render(),
        ];

        return response()->json($view);
    }
}


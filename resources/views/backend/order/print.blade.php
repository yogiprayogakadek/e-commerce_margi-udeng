@extends('backend.templates.master')

@section('title', 'Order')
@section('sub-title', 'Laporan')

@section('content')
    <div class="row printableArea">
        <div class="col-md-12" style="text-align: center">
            <h2><strong>E-Commerce Margi Udeng</strong></h2>
            <h3>
                <b>Laporan Data Order</b>
            </h3>
            <div class="pull-left py-5">
                <address>
                    <p class="m-t-30">
                        <img src="{{ asset('assets/landing/images/logo.png') }}" height="100">
                    </p>
                    <p class="m-t-30">
                        <b>Dicetak oleh :</b>
                        <i class="fa fa-user"></i> {{ auth()->user()->nama }}
                    </p>
                    <p class="m-t-30">
                        <b>Tanggal Laporan :</b>
                        <i class="fa fa-calendar"></i> {{ date('d-m-Y') }}
                    </p>
                </address>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered text-nowrap border-bottom dataTable no-footer" role="grid"
                        id="tableData">
                        <tr>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">No</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">Order Code</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">Customer</th>
                            <th colspan="6" class="text-center" style="vertical-align: middle">Detail Order</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">Total</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Size</th>
                            <th>Kuantitas</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                        @php
                            $grandTotal = 0;
                        @endphp
                        @foreach ($order as $order)
                            @foreach ($order->detail as $key => $data)
                                <tr>
                                    @if ($loop->first)
                                        <td rowspan="{{ count($order->detail) }}" class="text-center" style="vertical-align: middle">{{ $loop->parent->index + 1 }}</td>
                                        <td rowspan="{{ count($order->detail) }}" class="text-center" style="vertical-align: middle">{{ $order->order_code }}</td>
                                        <td rowspan="{{ count($order->detail) }}" class="text-center" style="vertical-align: middle">{{ $order->user->customer->nama }}</td>
                                        {{-- <td rowspan="{{ count($order->detail) }}"><img src="{{ asset($produk->foto) }}" width="100px"></td> --}}
                                    @endif
                                    <td>-</td>
                                    <td>{{$data->produk->nama}}</td>
                                    <td>{{toRupiah(json_decode($data->produk->data, true)[searchForSize($data->size, json_decode($data->produk->data, true))]['harga'])}}</td>
                                    <td>{{$data->size}}</td>
                                    <td class="text-center">{{$data->kuantitas}}</td>
                                    <td>{{toRupiah(json_decode($data->produk->data, true)[searchForSize($data->size, json_decode($data->produk->data, true))]['harga'] * $data->kuantitas)}}</td>
                                    @if ($loop->first)
                                        <td rowspan="{{ count($order->detail) }}" class="text-center" style="vertical-align: middle">{{toRupiah($order->pembayaran->total)}}</td>
                                    @endif
                                </tr>
                            @endforeach
                            @php
                                $grandTotal += $order->pembayaran->total;
                            @endphp
                        @endforeach
                        <tr>
                            <td colspan="9" class="text-center"><strong><i>Grand Total</i></strong></td>
                            <td><strong><i>{{toRupiah($grandTotal)}}</i></strong></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

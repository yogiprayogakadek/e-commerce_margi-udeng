@extends('backend.templates.master')

@section('title', 'Produk')
@section('sub-title', 'Laporan')

@section('content')
    <div class="row printableArea">
        <div class="col-md-12" style="text-align: center">
            <h2><strong>E-Commerce Margi Udeng</strong></h2>
            <h3>
                <b>Laporan Data Produk</b>
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
                            <th rowspan="2" class="text-center" style="vertical-align: middle">Kategori</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">Nama Produk</th>
                            <th rowspan="2" class="text-center" style="vertical-align: middle">Foto</th>
                            <th colspan="4" class="text-center" style="vertical-align: middle">Data</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            <th>Size</th>
                            <th>Harga</th>
                            <th>Stok</th>
                        </tr>
                        @foreach ($produk as $produk)
                            @foreach (json_decode($produk->data) as $key => $data)
                                <tr>
                                    @if ($loop->first)
                                        <td rowspan="{{ count(json_decode($produk->data)) }}" class="text-center" style="vertical-align: middle">{{ $loop->parent->index + 1 }}
                                        </td>
                                        <td rowspan="{{ count(json_decode($produk->data)) }}" class="text-center" style="vertical-align: middle">{{ $produk->kategori->nama }}</td>
                                        <td rowspan="{{ count(json_decode($produk->data)) }}" class="text-center" style="vertical-align: middle">{{ $produk->nama }}</td>
                                        <td rowspan="{{ count(json_decode($produk->data)) }}"><img src="{{ asset($produk->foto) }}" width="100px"></td>
                                    @endif
                                    <td>-</td>
                                    <td>{{ $data->size }}</td>
                                    <td>{{ toRupiah($data->harga) }}</td>
                                    <td>{{ $data->stok }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

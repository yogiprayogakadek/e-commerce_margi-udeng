@extends('landing.templates.master')

@push('css')
    <!-- dataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')
    <!--== Start Page Header Area Wrapper ==-->
    <section class="page-header-area" data-bg-color="#F1FAEE">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="page-header-content">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Account</li>
                        </ol>
                        <h2 class="page-header-title">My Account</h2>
                    </div>
                </div>
                <div class="col-sm-4 d-sm-flex justify-content-end align-items-end">
                    <h5 class="showing-pagination-results">Account</h5>
                </div>
            </div>
        </div>
    </section>
    <!--== End Page Header Area Wrapper ==-->

    <!--== Start My Account Wrapper ==-->
    <section class="account-area section-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="myaccount-page-wrapper">
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <nav>
                                    <div class="myaccount-tab-menu nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="dashboad-tab" data-bs-toggle="tab"
                                            data-bs-target="#dashboad" type="button" role="tab"
                                            aria-controls="dashboad" aria-selected="true">Dashboard</button>
                                        <button class="nav-link" id="orders-tab" data-bs-toggle="tab"
                                            data-bs-target="#orders" type="button" role="tab" aria-controls="orders"
                                            aria-selected="false"> Orders</button>
                                        <button class="nav-link" id="account-info-tab" data-bs-toggle="tab"
                                            data-bs-target="#account-info" type="button" role="tab"
                                            aria-controls="account-info" aria-selected="false">Account Details</button>
                                        <button class="nav-link" id="change-password-tab" data-bs-toggle="tab"
                                            data-bs-target="#change-password" type="button" role="tab"
                                            aria-controls="change-password" aria-selected="false">Change Password</button>
                                        <button class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                            type="button">Logout</button>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                    </div>
                                </nav>
                            </div>
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="dashboad" role="tabpanel"
                                        aria-labelledby="dashboad-tab">
                                        <div class="myaccount-content">
                                            <h3>Dashboard, {{ Auth::user()->customer->nama }}</h3>
                                            <div class="welcome">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5>Total Order</h5>
                                                            </div>
                                                            <div class="card-body text-center">
                                                                <h1>{{ totalOrder() }} Order</h1>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5>Total Belanja</h5>
                                                            </div>
                                                            <div class="card-body text-center">
                                                                <h1>{{ totalBelanja() }}</h1>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                        <div class="myaccount-content">
                                            <h3>Orders</h3>
                                            <div class="myaccount-table table-responsive text-center">
                                                <table class="table table-bordered" id="tableData">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Order Code</th>
                                                            <th>Status Pembayaran</th>
                                                            <th>Total</th>
                                                            <th>Tanggal Pemesanan</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse (orderByUser() as $order)
                                                            <tr>
                                                                <td>{{ $order->order_code }}</td>
                                                                <td>{{ $order->pembayaran->status }}</td>
                                                                <td>{{ toRupiah($order->pembayaran->total) }}</td>
                                                                <td>{{ date_format(date_create($order->created_at), 'd M Y') }}
                                                                </td>
                                                                <td><a href="javascript:void(0)"
                                                                        class="check-btn sqr-btn btn-detail"
                                                                        data-id="{{ $order->id }}">View</a></td>
                                                            </tr>
                                                        @empty
                                                            <tr>
                                                                <td colspan="5" class="text-center">Belum ada order</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="account-info" role="tabpanel"
                                        aria-labelledby="account-info-tab">
                                        <div class="myaccount-content">
                                            <h3>Account Details</h3>
                                            <div class="account-details-form">
                                                <form id="formAccount" action="{{ route('account.update') }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="single-input-item">
                                                        <label for="nama" class="required">Nama</label>
                                                        <input type="text" id="nama" name="nama"
                                                            value="{{ auth()->user()->customer->nama }}" />
                                                    </div>
                                                    <div class="single-input-item">
                                                        <label for="alamat" class="required">Alamat</label>
                                                        <input type="text" id="alamat" name="alamat"
                                                            value="{{ auth()->user()->customer->alamat }}" />
                                                    </div>
                                                    <div class="single-input-item">
                                                        <label for="telp" class="required">Telp</label>
                                                        <input type="text" id="telp" name="telp"
                                                            value="{{ auth()->user()->customer->telp }}" />
                                                    </div>
                                                    <div class="single-input-item">
                                                        <label for="email" class="required">Email Addres</label>
                                                        <input type="email" id="email" name="email"
                                                            value="{{ auth()->user()->email }}" />
                                                    </div>
                                                    <div class="single-input-item">
                                                        <button type="submit" class="check-btn sqr-btn btn-save">Save
                                                            Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="change-password" role="tabpanel"
                                        aria-labelledby="change-password-tab">
                                        <div class="myaccount-content">
                                            <h3>Change Password</h3>
                                            <div class="account-details-form">
                                                <form id="formPassword" action="{{ route('account.update.password') }}"
                                                    method="POST">
                                                    @csrf
                                                    {{-- <fieldset>
                                                        <legend>Password change</legend> --}}
                                                    <div class="single-input-item">
                                                        <label for="current-pwd" class="required">Current
                                                            Password</label>
                                                        <input type="password" id="current-pwd"
                                                            name="current_password" />
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="new-pwd" class="required">New
                                                                    Password</label>
                                                                <input type="password" id="new-pwd"
                                                                    name="new_password" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="confirm-pwd" class="required">Confirm
                                                                    Password</label>
                                                                <input type="password" id="confirm-pwd"
                                                                    name="confirm_password" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- </fieldset> --}}
                                                    <div class="single-input-item">
                                                        <button type="submit" class="check-btn sqr-btn btn-save">Save
                                                            Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h6 class="visually-hidden">My Account</h6>
    </section>
    <!--== End My Account Wrapper ==-->
@endsection

@section('modal')
    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail order</h5>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <table class="table table-responsive" id="tableDetail">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Size</th>
                                    <th>Kuantitas</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="total"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\AccountRequest', '#formAccount') !!}
    {!! JsValidator::formRequest('App\Http\Requests\PasswordRequest', '#formPassword') !!}
    <script>
        $('#tableData').DataTable({
            language: {
                paginate: {
                    previous: "<i class='fa fa-arrow-left'>",
                    next: "<i class='fa fa-arrow-right'>"
                },
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                lengthMenu: "Menampilkan _MENU_ data",
                search: "Cari:",
                emptyTable: "Tidak ada data tersedia",
                zeroRecords: "Tidak ada data yang cocok",
                loadingRecords: "Memuat data...",
                processing: "Memproses...",
                infoFiltered: "(difilter dari _MAX_ total data)"
            },
            lengthMenu: [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"]
            ],
        });

        $(document).ready(function() {
            $('body').on('click', '.btn-detail', function() {
                let order_id = $(this).data('id');

                $('#modal').modal('show')

                $('#tableDetail tbody').empty();
                $.get("/account/detail-order/" + order_id, function(result) {
                    $.each(result.data, function(index, value) {
                        let list = '<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + value.nama + '</td>' +
                            '<td>' + value.harga + '</td>' +
                            '<td>' + value.size + '</td>' +
                            '<td>' + value.kuantitas + '</td>' +
                            '<td class="subtotal text-end">' + value.subtotal + '</td>' +
                            '</tr>';

                        $('#tableDetail tbody').append(list)
                    });
                    $('.total').html('<p class="text-end"><strong>' + result.total +
                        '</strong></p>')
                });
            })

            @if (session('status'))
                Swal.fire(
                    "{{ session('title') }}",
                    "{{ session('message') }}",
                    "{{ session('status') }}",
                );
            @endif

            // $('body').on('click', '.btn-save', function() {
            //     $.ajaxSetup({
            //         headers: {
            //             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            //         },
            //     });
            //     let form = $("#formAccount")[0];
            //     let data = new FormData(form);

            //     $.ajax({
            //         type: "POST",
            //         url: "/account/update",
            //         data: data,
            //         processData: false,
            //         contentType: false,
            //         cache: false,
            //         beforeSend: function() {
            //             $(".btn-save").attr("disable", "disabled");
            //             $(".btn-save").html('<i class="fa fa-spin fa-spinner"></i>');
            //         },
            //         complete: function() {
            //             $(".btn-save").removeAttr("disable");
            //             $(".btn-save").html("Simpan");
            //         },
            //         success: function(response) {
            //             $("#formAccount").trigger("reset");
            //             $(".invalid-feedback").html("");
            //             Swal.fire(response.title, response.message, response.status);
            //         },
            //         error: function(error) {
            //             let formName = [];
            //             let errorName = [];

            //             $.each($("#formAccount").serializeArray(), function(i, field) {
            //                 formName.push(field.name.replace(/\[|\]/g, ""));
            //             });
            //             if (error.status == 422) {
            //                 if (error.responseJSON.errors) {
            //                     $.each(
            //                         error.responseJSON.errors,
            //                         function(key, value) {
            //                             errorName.push(key);
            //                             if ($("." + key).val() == "") {
            //                                 $("." + key).addClass("is-invalid");
            //                                 $(".error-" + key).html(value);
            //                             }
            //                         }
            //                     );
            //                     $.each(formName, function(i, field) {
            //                         $.inArray(field, errorName) == -1 ?
            //                             $("." + field).removeClass("is-invalid") :
            //                             $("." + field).addClass("is-invalid");
            //                     });
            //                 }
            //             }
            //         },
            //     });
            // })
        });
    </script>
@endpush

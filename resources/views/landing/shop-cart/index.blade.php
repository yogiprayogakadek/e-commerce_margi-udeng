@extends('landing.templates.master')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <!--== Start Page Header Area Wrapper ==-->
    <section class="page-header-area" data-bg-color="#F1FAEE">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="page-header-content">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('shopping.cart.index') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                        <h2 class="page-header-title">Keranjang Belanja</h2>
                    </div>
                </div>
                <div class="col-sm-4 d-sm-flex justify-content-end align-items-end">
                    <h5 class="showing-pagination-results">Cart Page</h5>
                </div>
            </div>
        </div>
    </section>
    <!--== End Page Header Area Wrapper ==-->

    <!--== Start Cart Area Wrapper ==-->
    <div class="shopping-cart-render">
        <section class="cart-page-area section-space">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cart-table-wrap">
                            <div class="cart-table table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="width-thumbnail"></th>
                                            <th class="width-name">Produk</th>
                                            <th class="width-size">Ukuran</th>
                                            <th class="width-price"> Harga</th>
                                            <th class="width-quantity">Kuantitas</th>
                                            <th class="width-subtotal">Subtotal</th>
                                            <th class="width-remove"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse (cart() as $cart)
                                            <tr>
                                                <td class="product-thumbnail">
                                                    <a
                                                        href="{{ route('landing.post.index', $cart->associatedModel['id']) }}"><img
                                                            class="w-100" src="{{ asset($cart->attributes['foto']) }}"
                                                            alt="Image" width="85" height="85"></a>
                                                </td>
                                                <td class="product-name">
                                                    <h5><a
                                                            href="{{ route('landing.post.index', $cart->associatedModel['id']) }}">{{ $cart->name }}</a>
                                                    </h5>
                                                </td>
                                                <td class="product-size"><span>{{ $cart->attributes['size'] }}</span></td>
                                                <td class="product-price"><span
                                                        class="amount">{{ toRupiah($cart->price) }}</span></td>
                                                <td class="cart-quality">
                                                    <div class="product-details-quality">
                                                        <div class="pro-qty">
                                                            <input type="text" title="Quantity"
                                                                value="{{ $cart->quantity }}">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="product-total">
                                                    <span>{{ toRupiah($cart->quantity * $cart->price) }}</span>
                                                </td>
                                                <td class="product-remove"><a href="javascript:void(0);" class="remove-item"
                                                        data-id="{{ $cart->id }}"><i class="fa fa-trash-o"></i></a></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">
                                                    <h3>Tidak ada produk</h3>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="cart-shiping-update-wrapper">
                            <div class="cart-shiping-btn continure-btn">
                                <a class="btn btn-link" href="{{ route('landing.index') }}"><i
                                        class="fa fa-angle-left"></i>
                                    Back To Shop</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                    </div>
                </div>
                @if (count(cart()) > 0)
                    <div class="row">
                        {{-- <div class="col-md-12 col-lg-8">
                            <div class="form-group">
                                <select name="provinces" id="provinces" class="form-control" style="width: 100%; height: 100%">
                                    <option value="OP">OP</option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="col-md-12 col-lg-8">
                            <div class="cart-calculate-discount-wrap mb-40">
                                <h4>Calculate shipping </h4>
                                <div class="calculate-discount-content">
                                    <div class="select-style">
                                        <select class="form-control provinces js-states" id="provinces" name="provinces"
                                            style="width: 100%;">
                                            <option></option>
                                            @foreach ($provinces as $item)
                                                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="select-style">
                                        <select class="form-control regencies js-states" id="regencies" name="regencies"
                                            style="width: 100%;"></select>
                                    </div>
                                    <div class="select-style">
                                        <select class="form-control districts js-states" id="districts" name="districts"
                                            style="width: 100%;"></select>
                                    </div>
                                    <div class="select-style">
                                        <select class="form-control villages js-states" id="villages" name="villages"
                                            style="width: 100%;"></select>
                                    </div>
                                    <div class="input-style mb-6">
                                        <input type="text" placeholder="Kode POS" name="kode_pos" id="kode-pos" hidden>
                                    </div>
                                    <div class="input-style">
                                        <input type="text" placeholder="Alamat lengkap" id="alamat" name="alamat"
                                            hidden>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4">
                            <div class="grand-total-wrap mt-10 mt-lg-0">
                                <div class="grand-total-content">
                                    <div class="grand-total">
                                        <h4>Total <span>{{ cartSubTotal() }}</span></h4>
                                    </div>
                                </div>
                                <div class="grand-total-btn">
                                    <a class="btn btn-link checkout" href="javascript:void(0)">Proceed to checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </div>
    <!--== End Cart Area Wrapper ==-->
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js">
    </script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-WLa4T_aeiQfLdfyC"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.nice-select').hide()
            $('#provinces').select2({
                placeholder: "Pilih Provinsi",
                allowClear: true
            });

            function paymentChecking(status_code, order_id) {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });

                $.ajax({
                    type: "POST",
                    url: "/shopping-cart/payment-checking",
                    data: {
                        status_code: status_code,
                        order_id: order_id,
                    },
                    success: function(response) {
                        Swal.fire(response.title, response.message, response.status);
                        getCart();
                        $("body").find(".item-total").text(response.cartTotal);
                        $('.shopping-cart-render').html(response.render.data)
                    }
                });
            }

            function screenLoading() {
                $.LoadingOverlay("show", {
                    image: "",
                    progress: true
                });
                var count = 0;
                var interval = setInterval(function() {
                    if (count >= 100) {
                        clearInterval(interval);
                        $.LoadingOverlay("hide");
                        return;
                    }
                    count += 10;
                    $.LoadingOverlay("progress", count);
                }, 200);
            }

            $("body").on("click", ".remove-item", function() {
                var id = $(this).data("id");
                Swal.fire({
                    title: "Anda yakin?",
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal",
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "/shopping-cart/remove-item/" + id,
                            type: "GET",
                            success: function(result) {
                                Swal.fire(result.title, result.message, result.status);
                                getCart();
                                $("body").find(".item-total").text(result.cartTotal);
                                if (result.status == 'success') {
                                    $('.shopping-cart-render').html(result.render.data)
                                }
                            },
                        });
                    }
                });
            });

            $('body').on('click', '.btn-checkout', function() {
                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });
                Swal.fire({
                    title: "Lanjutkan checkout?",
                    text: "Proses akan dilanjutkan ke tahap pembayaran!",
                    icon: "success",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, lanjutkan!",
                    cancelButtonText: "Batal",
                }).then((response) => {
                    if (response.value) {
                        $.ajax({
                            url: "/shopping-cart/checkout",
                            type: "POST",
                            data: {
                                provinsi: $('#provinces').find("option:selected").text(),
                                kabupaten: $('#regencies').find("option:selected").text(),
                                kecamatan: $('#districts').find("option:selected").text(),
                                desa: $('#villages').find("option:selected").text(),
                                kode_pos: $('#kode-pos').val(),
                                alamat: $('#alamat').val(),
                            },
                            success: function(res) {
                                screenLoading();
                                if (res.status == 'success') {
                                    snap.pay(res.midtransToken, {
                                        onSuccess: function(result) {
                                            paymentChecking(result
                                                .status_code, result
                                                .order_id);
                                            // Swal.fire('Berhasil', 'Pembayaran berhasil', 'success');
                                            // setTimeout(() => {
                                            //     location.reload();
                                            // }, 1000);
                                        },
                                        onPending: function(result) {
                                            paymentChecking(result
                                                .status_code, result
                                                .order_id);
                                            // Swal.fire('Info', 'Menunggu pembayaran', 'info');
                                            // setTimeout(() => {
                                            //     location.reload();
                                            // }, 1000);
                                        },
                                        onError: function(result) {
                                            paymentChecking(result
                                                .status_code, result
                                                .order_id);
                                            // Swal.fire('Gagal', 'Pembayaran gagal', 'error');
                                            // setTimeout(() => {
                                            //     location.reload();
                                            // }, 1000);
                                        }
                                    });
                                }
                            },
                        });
                    }
                });
            })

            $('body').on('change', '#provinces', function() {
                let province_id = $('select[name=provinces] option').filter(':selected').val()

                $('#regencies').empty();
                $.get("/shopping-cart/regency/" + province_id, function(data) {
                    $('#regencies').select2({
                        placeholder: "Pilih Kabupaten",
                        allowClear: true
                    });

                    let option = '<option></option>';
                    $.each(data, function(index, value) {
                        option += '<option value=' + value.id + '>' + value.name +
                            '</option>';
                    });
                    $('.regencies').append(option);
                });
            });

            $('body').on('change', '#regencies', function() {
                let regency_id = $('select[name=regencies] option').filter(':selected').val()

                $('#districts').empty();
                $.get("/shopping-cart/district/" + regency_id, function(data) {
                    $('#districts').select2({
                        placeholder: "Pilih Kecamatan",
                        allowClear: true
                    });

                    let option = '<option></option>';
                    $.each(data, function(index, value) {
                        option += '<option value=' + value.id + '>' + value.name +
                            '</option>';
                    });
                    $('.districts').append(option);
                });
            });

            $('body').on('change', '#districts', function() {
                let district_id = $('select[name=districts] option').filter(':selected').val();

                $('#kode-pos').prop('hidden', false)
                $('#alamat').prop('hidden', false)

                $('#villages').empty();
                $.get("/shopping-cart/village/" + district_id, function(data) {
                    $('#villages').select2({
                        placeholder: "Pilih Desa",
                        allowClear: true
                    });

                    let option = '<option></option>';
                    $.each(data, function(index, value) {
                        option += '<option value=' + value.id + '>' + value.name +
                            '</option>';
                    });
                    $('.villages').append(option);
                });
            });

            $('body').on('keyup', '#kode-pos', function() {
                let kodePos = $(this).val();
                let alamat = $('#alamat').val();

                $("#kode-pos").inputFilter(function(value) {
                    return /^\d*$/.test(value); // Allow digits only, using a RegExp
                }, "hanya angka");
                if (kodePos != '' && alamat != '') {
                    $('.checkout').addClass('btn-checkout')
                } else {
                    $('.checkout').removeClass('btn-checkout')
                }
            })

            $('body').on('keyup', '#alamat', function() {
                let alamat = $(this).val();
                let kodePos = $('#kode-pos').val();
                if (kodePos != '' && alamat != '') {
                    $('.checkout').addClass('btn-checkout')
                } else {
                    $('.checkout').removeClass('btn-checkout')
                }
            })
        });
    </script>
@endpush

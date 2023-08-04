@extends('landing.templates.master')

@section('content')
    <!--== Start Page Header Area Wrapper ==-->
    <section class="page-header-area" data-bg-color="#F1FAEE">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="page-header-content">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('shopping.cart.index')}}">Home</a></li>
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
                                <a class="btn btn-link" href="{{ route('landing.index') }}"><i class="fa fa-angle-left"></i>
                                    Back To Shop</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                    </div>
                </div>
                @if (count(cart()) > 0)
                    <div class="row">
                        <div class="col-md-12 col-lg-8">
                            <div class="cart-calculate-discount-wrap mb-40">
                                <h4>Calculate shipping </h4>
                                <div class="calculate-discount-content">
                                    <div class="select-style">
                                        <select class="select-active">
                                            @foreach ($data as $item)
                                                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="select-style">
                                        <select class="select-active">
                                            <option>State / County</option>
                                            <option>Bahrain</option>
                                            <option>Azerbaijan</option>
                                            <option>Barbados</option>
                                            <option>Barbados</option>
                                        </select>
                                    </div>
                                    <div class="input-style">
                                        <input type="text" placeholder="Town / City">
                                    </div>
                                    <div class="input-style mb-6">
                                        <input type="text" placeholder="Postcode / ZIP">
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
                                    <a class="btn btn-link btn-checkout" href="javascript:void(0)">Proceed to checkout</a>
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
    <script>
        $(document).ready(function() {

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
                            success: function(res) {
                                screenLoading();
                                if (res.status == 'success') {
                                    snap.pay(res.midtransToken, {
                                        onSuccess: function(result) {
                                            paymentChecking(result
                                                .status_code, result.order_id);
                                            // Swal.fire('Berhasil', 'Pembayaran berhasil', 'success');
                                            // setTimeout(() => {
                                            //     location.reload();
                                            // }, 1000);
                                        },
                                        onPending: function(result) {
                                            paymentChecking(result
                                                .status_code, result.order_id);
                                            // Swal.fire('Info', 'Menunggu pembayaran', 'info');
                                            // setTimeout(() => {
                                            //     location.reload();
                                            // }, 1000);
                                        },
                                        onError: function(result) {
                                            paymentChecking(result
                                                .status_code, result.order_id);
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
        });
    </script>
@endpush

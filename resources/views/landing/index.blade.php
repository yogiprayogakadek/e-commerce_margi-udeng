@extends('landing.templates.master')

@section('content')
    <!--== Start Product Banner Area Wrapper ==-->
    <section class="product-banner-area section-top-space">
        <div class="container">
            <div class="swiper banner-slider-container">
                <div class="swiper-wrapper">
                    <a href="shop.html" class="swiper-slide product-banner-item">
                        <img class="icon" src="{{ asset('assets/landing/images/shop/banner/01.png') }}" width="370"
                            height="294" alt="Image-HasTech">
                    </a>
                    <a href="shop.html" class="swiper-slide product-banner-item">
                        <img class="icon" src="{{ asset('assets/landing/images/shop/banner/02.png') }}" width="370"
                            height="294" alt="Image-HasTech">
                    </a>
                    <a href="shop.html" class="swiper-slide product-banner-item">
                        <img class="icon" src="{{ asset('assets/landing/images/shop/banner/03.png') }}" width="370"
                            height="294" alt="Image-HasTech">
                    </a>
                </div>
            </div>
        </div>
        <h6 class="visually-hidden">Banner Section</h6>
    </section>
    <!--== End Product Banner Area Wrapper ==-->

    <!--== Start Product Area Wrapper ==-->
    <section class="product-area section-space">
        <div class="container">
            <div class="section-title text-center">
                <h2 class="title">Best Products</h2>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
            <div class="row mb-n6">
                @forelse ($produk as $key => $value)
                    <div class="col-sm-6 col-lg-4 mb-6">
                        <!--== Start Product Item ==-->
                        <div class="product-item product-item-border">
                            <a class="product-thumb" href="shop-single-product.html">
                                <img src="{{ asset($value->foto) }}" width="300" height="286" alt="Image-HasTech">
                            </a>
                            {{-- <span class="badges">New</span> --}}
                            <div class="product-action">
                                <button type="button" class="product-action-btn action-btn-quick-view btn-modal"
                                    data-id="{{ $value->id }}">
                                    <i class="fa fa-expand"></i>
                                </button>
                                {{-- <button type="button" class="product-action-btn action-btn-quick-view"
                                data-bs-toggle="modal" data-bs-target="#action-QuickViewModal1">
                                <i class="fa fa-expand"></i>
                            </button> --}}
                                {{-- <button type="button" class="product-action-btn action-btn-cart"
                                data-bs-toggle="modal" data-bs-target="#action-CartAddModal">
                                <i class="fa fa-shopping-cart"></i>
                            </button>
                            <button type="button" class="product-action-btn action-btn-compare"
                                data-bs-toggle="modal" data-bs-target="#action-CompareModal">
                                <i class="fa fa-exchange"></i>
                            </button> --}}
                            </div>
                            <div class="product-info">
                                <h4 class="title"><a href="shop-single-product.html">{{ $value->nama }}</a>
                                </h4>
                                <div class="price">$650.00</div>
                                <button type="button" class="info-btn-wishlist" data-bs-toggle="modal"
                                    data-bs-target="#action-WishlistModal">
                                    <i class="fa fa-heart-o"></i>
                                </button>
                            </div>
                        </div>
                        <!--== End prPduct Item ==-->
                    </div>
                @empty
                    <div class="section-title text-center">
                        <h2 class="title">Belum ada produk</h2>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <!--== End Product Area Wrapper ==-->
@endsection

@section('modal')
    <aside class="product-cart-view-modal modal fade" id="modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="product-quick-view-content">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"><span>×</span></button>
                        <div class="row row-gutter-0">
                            <div class="col-lg-6">
                                <div class="single-product-slider">
                                    <div class="single-product-thumb">
                                        {{-- render from javascript --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="product-details-content pt-3">
                                    <h3 class="product-details-title"></h3>
                                    {{-- <div class="product-details-review">
                                        <div class="product-review-icon">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                        </div>
                                        <button type="button" class="product-review-show">156 reviews</button>
                                    </div> --}}
                                    <p class="product-details-desc"></p>
                                    <div class="product-details-color-list">
                                        {{-- <h4>Size:</h4> --}}
                                    </div>
                                    {{-- <div class="product-details-pro-qty">
                                        <h4>QTY :</h4>
                                        <div class="pro-qty">
                                            <input type="text" title="Quantity" value="01">
                                        </div>
                                    </div> --}}
                                    <div class="product-details-price">
                                        <span class="new-price"></span>
                                        <span style="font-size: 10px">(mulai dari)</span>
                                    </div>
                                    <div class="product-details-action">
                                        <button type="button" class="product-action-btn" data-bs-toggle="modal"
                                            data-bs-target="#action-CartAddModal">Detail</button>
                                        {{-- <button type="button" class="product-action-wishlist" data-bs-toggle="modal"
                                            data-bs-target="#action-WishlistModal">
                                            <i class="fa fa-heart"></i>
                                        </button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>
@endsection

@push('script')
    <script src="{{asset('assets/main/functions/main.js')}}"></script>
    <script>
        function assets(url) {
            var url = '{{ url('') }}/' + url;
            return url;
        }
        $('body').on('click', '.btn-modal', function() {
            let produk_id = $(this).data('id');
            $('#modal').modal('show');

            $.get("/detail-produk/" + produk_id, function(data) {
                let swiperSlides = ''; // Initialize an empty string to hold swiper slides

                $('.single-product-thumb').empty();
                $.each(data.foto, function(index, value) {
                    let foto = '<div class="swiper-slide">' +
                        '<div class="thumb-item">' +
                        '<img src="' + assets(value) + '" alt="Image" width="640" height="710">' +
                        '</div>' +
                        '</div>';

                    swiperSlides += foto; // Append each swiper slide to the swiperSlides string
                });

                // Construct the full swiper HTML with the swiperSlides
                let swiperHtml = '<div class="swiper single-product-quick-view-slider">' +
                    '<div class="swiper-wrapper">' +
                    swiperSlides +
                    '</div>' +
                    '<div class="swiper-button-next"></div>' +
                    '<div class="swiper-button-prev"></div>' +
                    '</div>';

                $('.single-product-thumb').append(swiperHtml);

                // Initialize the Swiper for the newly added content
                new Swiper('.single-product-quick-view-slider', {
                    slidesPerView: 1,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                });

                // Produk
                $('.product-details-title').text(data.produk.nama)
                $('.product-details-desc').text(data.produk.deskripsi)
                $('.new-price').text(convertToRupiah(data.harga[0]))
                $('.product-details-color-list').empty().append('<h4>Size:</h4>');
                $.each(data.size, function (index, value) {
                    let size = '<div class="color-list-check">' +
                                    '<label class="form-check-label" for="colorLista'+index+'">'+value+'</label>' +
                                '</div>';
                    $('.product-details-color-list').append(size);
                });
            });
        });
    </script>
@endpush

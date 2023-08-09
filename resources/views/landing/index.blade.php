@extends('landing.templates.master')

@section('content')
    <!--== Start Hero Area Wrapper ==-->
    <section class="hero-slider-area position-relative">
        <div class="swiper hero-slider-container">
            <div class="swiper-wrapper">
                <div class="swiper-slide hero-slide-item">
                    <div class="container">
                        <div class="row align-items-center position-relative">
                            <div class="col-12 col-sm-6">
                                <div class="hero-slide-content">
                                    <div class="hero-slide-shape-img"><img
                                            src="{{ asset('assets/landing/images/slider/shape1.png') }}" width="180"
                                            height="180" alt="Image"></div>
                                    <h4 class="hero-slide-sub-title">Selamat Datang di Margi Udeng E-Commerce!</h4>
                                    <h1 class="hero-slide-title">Pakaian Adat Bali Anda!
                                    </h1>
                                    <p class="hero-slide-desc">Selamat berbelanja pakaian adat Bali yang memukau dan menawan
                                        di Margi Udeng. Nikmati keunikan motif dan tenunan khas Bali untuk tampilan yang
                                        memikat hati. Jelajahi koleksi kami yang kaya akan warisan budaya Bali, dan rasakan
                                        pesonanya mengalir dalam setiap jahitan.</p>
                                    <div class="hero-slide-meta">
                                        <a class="btn btn-border-primary" href="#product-area">Belanja Sekarang</a>
                                        {{-- <a class="ht-popup-video" data-fancybox data-type="iframe"
                                            href="https://player.vimeo.com/video/172601404?autoplay=1">
                                            <i class="fa fa-play icon"></i>
                                            <span>Play Now</span>
                                        </a> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="hero-slide-thumb">
                                    <img src="{{ asset('assets/landing/images/shop/banner/landing.png') }}" width="555"
                                        height="550" alt="Image">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="hero-social">
                            <a href="https://www.facebook.com/" target="_blank" rel="noopener">fb</a>
                            <a href="https://www.twitter.com/" target="_blank" rel="noopener">tw</a>
                            <a href="https://www.linkedin.com/" target="_blank" rel="noopener">in</a>
                        </div> --}}
                    </div>
                </div>
                <div class="swiper-slide hero-slide-item">
                    <div class="container">
                        <div class="row align-items-center position-relative">
                            <div class="col-12 col-sm-6">
                                <div class="hero-slide-content">
                                    <div class="hero-slide-shape-img"><img
                                            src="{{ asset('assets/landing/images/slider/shape1.png') }}" width="180"
                                            height="180" alt="Image"></div>
                                            <h4 class="hero-slide-sub-title">Selamat Datang di Margi Udeng E-Commerce!</h4>
                                            <h1 class="hero-slide-title">Pakaian Adat Bali Anda!
                                            </h1>
                                            <p class="hero-slide-desc">Selamat berbelanja pakaian adat Bali yang memukau dan menawan
                                                di Margi Udeng. Nikmati keunikan motif dan tenunan khas Bali untuk tampilan yang
                                                memikat hati. Jelajahi koleksi kami yang kaya akan warisan budaya Bali, dan rasakan
                                                pesonanya mengalir dalam setiap jahitan.</p>
                                            <div class="hero-slide-meta">
                                                <a class="btn btn-border-primary" href="#product-area">Belanja Sekarang</a>
                                                {{-- <a class="ht-popup-video" data-fancybox data-type="iframe"
                                                    href="https://player.vimeo.com/video/172601404?autoplay=1">
                                                    <i class="fa fa-play icon"></i>
                                                    <span>Play Now</span>
                                                </a> --}}
                                            </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="hero-slide-thumb">
                                    <img src="{{ asset('assets/landing/images/slider/slider1-man2.png') }}" width="555"
                                        height="550" alt="Image">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="hero-social">
                            <a href="https://www.facebook.com/" target="_blank" rel="noopener">fb</a>
                            <a href="https://www.twitter.com/" target="_blank" rel="noopener">tw</a>
                            <a href="https://www.linkedin.com/" target="_blank" rel="noopener">in</a>
                        </div> --}}
                    </div>
                </div>
            </div>
            <!--== Add Pagination ==-->
            <div class="hero-slider-pagination"></div>
        </div>
    </section>
    <!--== End Hero Area Wrapper ==-->
    <!--== Start Product Banner Area Wrapper ==-->
    <section class="product-banner-area section-top-space">
        <div class="container">
            <div class="swiper banner-slider-container">
                <div class="swiper-wrapper">
                    <a href="{{route('landing.by.category', 'all')}}" class="swiper-slide product-banner-item">
                        <img class="icon" src="{{ asset('assets/landing/images/shop/banner/kebaya.png') }}" width="370"
                            height="294" alt="Image-HasTech">
                    </a>
                    <a href="{{route('landing.by.category', 'all')}}" class="swiper-slide product-banner-item">
                        <img class="icon" src="{{ asset('assets/landing/images/shop/banner/saputan.png') }}" width="370"
                            height="294" alt="Image-HasTech">
                    </a>
                    <a href="{{route('landing.by.category', 'all')}}" class="swiper-slide product-banner-item">
                        <img class="icon" src="{{ asset('assets/landing/images/shop/banner/sandal.jpg') }}" width="370"
                            height="294" alt="Image-HasTech">
                    </a>
                </div>
            </div>
        </div>
        <h6 class="visually-hidden">Banner Section</h6>
    </section>
    <!--== End Product Banner Area Wrapper ==-->

    <!--== Start Product Area Wrapper ==-->
    <section class="product-area section-space" id="product-area">
        <div class="container">
            <div class="section-title text-center">
                <h2 class="title">Best Products</h2>
                <p>Pilih produk terbaik kamu</p>
            </div>
            <div class="row mb-n6 pagination-product">
                {{-- <div class="pagination-product"> --}}
                    @include('landing.pagination.index', ['produk' => $produk])
                {{-- </div> --}}
                {{-- @forelse ($produk as $key => $value)
                    <div class="col-sm-6 col-lg-4 mb-6"> --}}
                        <!--== Start Product Item ==-->
                        {{-- <div class="product-item product-item-border">
                            <a class="product-thumb" href="{{ route('landing.post.index', $value->id) }}">
                                <img src="{{ asset($value->foto) }}" width="300" height="286" alt="Image-HasTech">
                            </a> --}}
                            {{-- <span class="badges">New</span> --}}
                            {{-- <div class="product-action">
                                <button type="button" class="product-action-btn action-btn-quick-view btn-modal"
                                    data-id="{{ $value->id }}">
                                    <i class="fa fa-expand"></i>
                                </button>
                            </div>
                            <div class="product-info">
                                <h4 class="title"><a href="{{ route('landing.post.index', $value->id) }}">{{ $value->nama }}</a>
                                </h4>
                                <div class="price">{!!$value->harga_terendah == $value->harga_tertinggi ? toRupiah($value->harga_terendah) . '</br></br>' : toRupiah($value->harga_terendah) . '-' . toRupiah($value->harga_tertinggi)!!}</div>
                                <a href="{{ route('landing.post.index', $value->id) }}">
                                <button type="button" class="info-btn-wishlist">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </a>
                            </div>
                        </div> --}}
                        <!--== End prPduct Item ==-->
                    {{-- </div> --}}
                {{-- @empty
                    <div class="section-title text-center">
                        <h2 class="title">Belum ada produk</h2>
                    </div>
                @endforelse --}}

                {{-- <div class="d-flex justify-content-center pagination-container">
                {!! $produk->links() !!}
                </div> --}}
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
                                        <button type="button" class="product-action-btn detail-button">Detail</button>
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
    <script src="{{ asset('assets/main/functions/main.js') }}"></script>
    <script>
        function assets(url) {
            var url = '{{ url('') }}/' + url;
            return url;
        }
        $('body').on('click', '.btn-modal', function() {
            let produk_id = $(this).data('id');
            localStorage.setItem('produk_id', produk_id);
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
                $.each(data.size, function(index, value) {
                    let size = '<div class="color-list-check">' +
                        '<label class="form-check-label" for="colorLista' + index + '">' + value +
                        '</label>' +
                        '</div>';
                    $('.product-details-color-list').append(size);
                });
            });
        });

        $('body').on('click', '.detail-button', function() {
            let produk_id = localStorage.getItem('produk_id')
            window.location = '/post/' + produk_id
        });

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            let url = $(this).attr('href');

            $.ajax({
                url: url,
                success: function(data) {
                    $('.pagination-product').html(data.html);

                    // Update pagination links container
                    // $('.pagination-container').html($(data).find('.pagination'));
                }
            });
        });
    </script>
@endpush

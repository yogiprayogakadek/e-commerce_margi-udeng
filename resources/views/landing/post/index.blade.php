@extends('landing.templates.master')

@section('content')
    <!--== Start Page Header Area Wrapper ==-->
    {{-- <section class="page-header-area" data-bg-color="#F1FAEE">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="page-header-content">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product Detail</li>
                        </ol>
                        <h2 class="page-header-title">Beat deal with best product.</h2>
                    </div>
                </div>
                <div class="col-sm-4 d-sm-flex justify-content-end align-items-end">
                    <h5 class="showing-pagination-results">Product Detail</h5>
                </div>
            </div>
        </div>
    </section> --}}
    <!--== End Page Header Area Wrapper ==-->

    <!--== Start Product Details Area Wrapper ==-->
    <section class="product-detail-area section-space">
        <div class="container">
            <div class="row product-details">
                <div class="col-lg-7">
                    <div class="product-details-thumb me-lg-6">
                        <div class="swiper single-product-thumb-slider">
                            <div class="swiper-wrapper">
                                @foreach ($data['foto'] as $image)
                                    <a class="lightbox-image swiper-slide" data-fancybox="gallery"
                                        href="{{ asset($image) }}">
                                        <img src="{{ asset($image) }}" width="640" height="530" alt="Image">
                                        <span class="badges">New</span>
                                    </a>
                                @endforeach
                            </div>
                            <!-- swiper pagination -->
                            <div class="swiper-pagination"></div>
                        </div>
                        <div class="swiper single-product-nav-slider">
                            <div class="swiper-wrapper">
                                @foreach ($data['foto'] as $subImage)
                                    <div class="nav-item swiper-slide">
                                        <img src="{{ asset($subImage) }}" alt="Image" width="305" height="253">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="product-details-content">
                        <h3 class="product-details-title">{{ $data['produk']->nama }}</h3>
                        <p class="product-details-desc">{{ $data['produk']->deskripsi }}</p>
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
                        <div class="product-details-size-list">
                            @foreach ($data['size'] as $size)
                                <div class="size-list-check">
                                    <input class="form-check-input" type="radio" name="flexRadioSizeList" id="btn-size"
                                        data-size="{{ $size }}" data-produk-id="{{ $data['produk']->id }}">
                                    <label class="form-check-label" for="sizeSList1">{{ $size }}</label>
                                </div>
                            @endforeach
                        </div>
                        {{-- <div class="product-details-color-list">
                            <h4>Color:</h4>
                            <div class="color-list-check">
                                <input class="form-check-input bg-red" type="radio" name="flexRadioColorList" id="colorList1">
                                <label class="form-check-label" for="colorList1">Red</label>
                            </div>
                            <div class="color-list-check">
                                <input class="form-check-input bg-green" type="radio" name="flexRadioColorList" id="colorList2" checked>
                                <label class="form-check-label" for="colorList2">Green</label>
                            </div>
                            <div class="color-list-check me-0">
                                <input class="form-check-input bg-blue" type="radio" name="flexRadioColorList" id="colorList3">
                                <label class="form-check-label" for="colorList3">Blue</label>
                            </div>
                        </div> --}}
                        <div class="product-details-pro-qty">
                            <h4>QTY :</h4>
                            <div class="pro-qty">
                                <input type="text" title="Quantity" value="1" min="1" name="qty">
                            </div>
                        </div>
                        <div class="product-details-price"></div>
                        <div class="product-details-action">
                            <button type="button" class="product-action-btn add-button"
                                data-auth="{{ Auth::check() == true ? 'logged' : 'not-logged' }}">Add to cart</button>
                            {{-- <button type="button" class="product-action-wishlist" data-bs-toggle="modal" data-bs-target="#action-WishlistModal">
                                <i class="fa fa-heart"></i>
                            </button> --}}
                        </div>
                    </div>
                </div>
            </div>


            {{-- <div class="row">
                <div class="col-lg-7">
                    <div class="nav product-details-nav me-lg-6" id="product-details-nav-tab" role="tablist">
                        <button class="nav-link" id="specification-tab" data-bs-toggle="tab" data-bs-target="#specification" type="button" role="tab" aria-controls="specification" aria-selected="false">Specification</button>
                        <button class="nav-link active" id="review-tab" data-bs-toggle="tab" data-bs-target="#review" type="button" role="tab" aria-controls="review" aria-selected="true">Review</button>
                    </div>
                    <div class="tab-content me-lg-6" id="product-details-nav-tabContent">
                        <div class="tab-pane" id="specification" role="tabpanel" aria-labelledby="specification-tab">
                            <ul class="product-details-info-wrap">
                                <li><span>Weight :</span> 250 g</li>
                                <li><span>Dimensions :</span>10 x 10 x 15 cm</li>
                                <li><span>Materials :</span> 60% cotton, 40% polyester</li>
                                <li><span>Other Info :</span> American heirloom jean shorts pug seitan letterpress</li>
                            </ul>

                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius velit corporis quo voluptate culpa soluta, esse accusamus, sunt quia omnis amet temporibus sapiente harum quam itaque libero tempore. Ipsum, ducimus. lorem</p>
                        </div>

                        <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
                            <!--== Start Reviews Content Item ==-->
                            <div class="product-review-item">
                                <div class="product-review-top">
                                    <div class="product-review-thumb">
                                        <img src="{{asset('assets/landing/images/shop/details/c1.png')}}" alt="Images">
                                    </div>
                                    <div class="product-review-content">
                                        <h4 class="product-reviewer-name">Tomas Doe</h4>
                                        <h5 class="product-reviewer-designation">Delveloper</h5>
                                        <div class="product-review-icon">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed viverra amet, sodales faucibus nibh. Vivamus amet potenti ultricies nunc gravida duis. Nascetur scelerisque massa sodales egestas augue neque euismod scelerisque viverra.</p>
                                <button type="button" class="review-reply"><i class="fa fa fa-undo"></i></button>
                            </div>
                            <!--== End Reviews Content Item ==-->

                            <!--== Start Reviews Content Item ==-->
                            <div class="product-review-item product-review-reply">
                                <div class="product-review-top">
                                    <div class="product-review-thumb">
                                        <img src="{{asset('assets/landing/images/shop/details/c2.png')}}" alt="Images">
                                    </div>
                                    <div class="product-review-content">
                                        <h4 class="product-reviewer-name">Robat Fiftyk</h4>
                                        <h5 class="product-reviewer-designation">UI/UX Designer</h5>
                                        <div class="product-review-icon">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed viverra amet, sodales faucibus nibh. Vivamus amet potenti ultricies nunc gravida duis. Nascetur scelerisque massa sodales egestas augue neque euismod scelerisque viverra.</p>
                                <button type="button" class="review-reply"><i class="fa fa fa-undo"></i></button>
                            </div>
                            <!--== End Reviews Content Item ==-->

                            <!--== Start Reviews Content Item ==-->
                            <div class="product-review-item mb-0">
                                <div class="product-review-top">
                                    <div class="product-review-thumb">
                                        <img src="{{asset('assets/landing/images/shop/details/c3.png')}}" alt="Images">
                                    </div>
                                    <div class="product-review-content">
                                        <h4 class="product-reviewer-name">Arry twentyk</h4>
                                        <h5 class="product-reviewer-designation">UI/UX Designer</h5>
                                        <div class="product-review-icon">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed viverra amet, sodales faucibus nibh. Vivamus amet potenti ultricies nunc gravida duis. Nascetur scelerisque massa sodales egestas augue neque euismod scelerisque viverra.</p>
                                <button type="button" class="review-reply"><i class="fa fa fa-undo"></i></button>
                            </div>
                            <!--== End Reviews Content Item ==-->
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="product-reviews-form-wrap">
                        <h4 class="product-form-title">Leave a reply</h4>
                        <div class="product-reviews-form">
                            <form action="#">
                                <div class="form-input-item">
                                    <textarea class="form-control" placeholder="Enter you feedback"></textarea>
                                </div>
                                <div class="form-input-item">
                                    <input class="form-control" type="text" placeholder="Full Name">
                                </div>
                                <div class="form-input-item">
                                    <input class="form-control" type="email" placeholder="Email Address">
                                </div>
                                <div class="form-input-item">
                                    <div class="form-ratings-item">
                                        <div class="product-ratingsform-form-icon">
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </div>
                                        <span class="title">Provide Your Ratings</span>
                                    </div>
                                </div>
                                <div class="form-input-item mb-0">
                                    <button type="submit" class="btn">SUBMIT</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
    <!--== End Product Details Area Wrapper ==-->
@endsection

@push('script')
    <script>
        localStorage.clear();
        $('body').on('click', '#btn-size', function() {
            let size = $(this).data('size');
            let produk_id = $(this).data('produk-id');

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $.ajax({
                type: "POST",
                url: "/post/detail-by-size",
                data: {
                    size: size,
                    produk_id: produk_id
                },
                success: function(response) {
                    localStorage.setItem('produk_id', produk_id);
                    localStorage.setItem('size', size);
                    localStorage.setItem('harga', response.harga);
                    $(".product-details-price").text(response.harga);
                },
                error: function(error) {
                    console.log("Error", error);
                },
            });
        });

        $('body').on('click', '.add-button', function() {
            let auth = $(this).data('auth');
            if (auth != 'logged') {
                Swal.fire(
                    'Info',
                    'Mohon login untuk menambahkan ke keranjang',
                    'info'
                );
                return false;
            }
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            Swal.fire({
                title: "Tambahkan belanjaan",
                text: "Tambahkan ke dalam keranjang belanja?",
                icon: "success",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, tambahkan!",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "/cart/add",
                        data: {
                            produk_id: localStorage.getItem('produk_id'),
                            size: localStorage.getItem('size'),
                            qty: $('input[name=qty]').val()
                        },
                        success: function(response) {
                            Swal.fire(response.title, response.message, response.status);
                            getCart();
                            $('body').find('.item-total').text(response.cartTotal)
                            localStorage.clear();
                            $('input[name="flexRadioSizeList"]').prop("checked", false);
                        },
                    });
                }
            });
        })
    </script>
@endpush

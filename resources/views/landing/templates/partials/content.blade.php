<main class="main-content">


    @yield('content')

    {{-- PASTE DISINI --}}

</main>

<!--== Scroll Top Button ==-->
<div class="scroll-to-top"><span class="fa fa-angle-double-up"></span></div>

<!--== Start Product Quick View Modal ==-->
@yield('modal')
<!--== End Product Quick View Modal ==-->

<!--== Start Product Quick Wishlist Modal ==-->
{{-- <aside class="product-action-modal modal fade" id="action-WishlistModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="product-action-view-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                    <div class="modal-action-messages">
                        <i class="fa fa-check-square-o"></i> Added to wishlist successfully!
                    </div>
                    <div class="modal-action-product">
                        <div class="thumb">
                            <img src="{{asset('assets/landing/images/shop/modal1.jpg')}}" alt="Organic Food Juice" width="466"
                                height="320">
                        </div>
                        <h4 class="product-name"><a href="single-product.html">CRAS NEQUE METUS</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside> --}}
<!--== End Product Quick Wishlist Modal ==-->

<!--== Start Product Quick Add Cart Modal ==-->
{{-- <aside class="product-action-modal modal fade" id="action-CartAddModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="product-action-view-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                    <div class="modal-action-messages">
                        <i class="fa fa-check-square-o"></i> Added to cart successfully!
                    </div>
                    <div class="modal-action-product">
                        <div class="thumb">
                            <img src="{{asset('assets/landing/images/shop/modal1.jpg')}}" alt="Organic Food Juice" width="466"
                                height="320">
                        </div>
                        <h4 class="product-name"><a href="single-product.html">CRAS NEQUE METUS</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside> --}}
<!--== End Product Quick Add Cart Modal ==-->

<!--== Start Product Quick Add Cart Modal ==-->
{{-- <aside class="product-action-modal modal fade" id="action-CompareModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="product-action-view-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                    <div class="modal-action-messages">
                        <i class="fa fa-check-square-o"></i> Added to compare successfully!
                    </div>
                    <div class="modal-action-product">
                        <div class="thumb">
                            <img src="{{asset('assets/landing/images/shop/modal1.jpg')}}" alt="Organic Food Juice" width="466"
                                height="320">
                        </div>
                        <h4 class="product-name"><a href="single-product.html">CRAS NEQUE METUS</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside> --}}
<!--== End Product Quick Add Cart Modal ==-->

<!--== Start Sidebar Cart Menu ==-->
{{-- <aside class="sidebar-cart-modal offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1"
    id="offcanvasWithCartSidebar">
    <div class="offcanvas-header">
        <button type="button" class="btn-close cart-close" data-bs-dismiss="offcanvas"
            aria-label="Close">×</button>
    </div>
    <div class="sidebar-cart-inner offcanvas-body">
        <div class="sidebar-cart-content">
            <div class="sidebar-cart-all">
                <div class="cart-header">
                    <h3>Shopping Cart</h3>
                    <div class="close-style-wrap">
                        <span class="close-style close-style-width-1 cart-close"></span>
                    </div>
                </div>
                <div class="cart-content cart-content-padding">
                    <ul>
                        <li class="single-product-cart">
                            <div class="cart-img">
                                <a href="shop-single-product.html"><img src="{{asset('assets/landing/images/shop/s1.jpg')}}"
                                        alt="Image" width="70" height="67"></a>
                            </div>
                            <div class="cart-title">
                                <h4><a href="shop-single-product.html">Strapless Crop Top Gown</a></h4>
                                <span> 1 × <span class="price"> $12.00 </span></span>
                            </div>
                            <div class="cart-delete">
                                <a href="#/"><i class="pe-7s-trash icons"></i></a>
                            </div>
                        </li>
                        <li class="single-product-cart">
                            <div class="cart-img">
                                <a href="shop-single-product.html"><img src="{{asset('assets/landing/images/shop/s2.jpg')}}"
                                        alt="Image" width="70" height="67"></a>
                            </div>
                            <div class="cart-title">
                                <h4><a href="shop-single-product.html">Short Lilac Ruffled Dress</a></h4>
                                <span> 1 × <span class="price"> $59.90 </span></span>
                            </div>
                            <div class="cart-delete">
                                <a href="#/"><i class="pe-7s-trash icons"></i></a>
                            </div>
                        </li>
                    </ul>
                    <div class="cart-total">
                        <h4>Subtotal: <span>$71.90</span></h4>
                    </div>
                    <div class="cart-checkout-btn">
                        <a class="cart-btn" href="shop-cart.html">view cart</a>
                        <a class="checkout-btn" href="shop-checkout.html">checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside> --}}
<!--== End Sidebar Cart Menu ==-->

<!--== Start Aside Search Menu ==-->
{{-- <aside class="aside-search-box-wrapper offcanvas offcanvas-top" data-bs-scroll="true" tabindex="-1"
    id="AsideOffcanvasSearch">
    <div class="offcanvas-header">
        <h5 class="d-none" id="offcanvasTopLabel">Aside Search</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">×</button>
    </div>
    <div class="offcanvas-body">
        <div class="container pt--0 pb--0">
            <div class="search-box-form-wrap">
                <div class="search-note">
                    <p>Start typing and press Enter to search</p>
                </div>
                <form action="#" method="post">
                    <div class="search-form position-relative">
                        <label for="search-input" class="visually-hidden">Search</label>
                        <input id="search-input" type="search" class="form-control"
                            placeholder="Search entire store…">
                        <button class="search-button" type="button"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</aside> --}}
<!--== End Aside Search Menu ==-->

<!--== Start Side Menu ==-->
{{-- <aside class="aside-side-menu-wrapper off-canvas-area offcanvas offcanvas-end" data-bs-scroll="true"
    tabindex="-1" id="offcanvasWithBothOptions">
    <div class="offcanvas-header" data-bs-dismiss="offcanvas">
        <h5>Menu</h5>
        <button type="button" class="btn-close">×</button>
    </div>
    <div class="offcanvas-body">
        <!-- Start Mobile Menu Wrapper -->
        <div class="res-mobile-menu">
            <nav id="offcanvasNav" class="offcanvas-menu">
                <ul>
                    <li><a href="javascript:void(0)">Home</a>
                        <ul>
                            <li><a href="index.html">Home One</a></li>
                            <li><a href="index-two.html">Home Two</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">Shop</a>
                        <ul>
                            <li><a href="javascript:void(0)">Shop Layout</a>
                                <ul>
                                    <li><a href="shop.html">Shop 3 Column</a></li>
                                    <li><a href="shop-four-columns.html">Shop 4 Column</a></li>
                                    <li><a href="shop-left-sidebar.html">Shop Left Sidebar</a></li>
                                    <li><a href="shop-right-sidebar.html">Shop Right Sidebar</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)">Single Product</a>
                                <ul>
                                    <li><a href="shop-single-product.html">Single Product Normal</a></li>
                                    <li><a href="shop-single-product-variable.html">Single Product Variable</a>
                                    </li>
                                    <li><a href="shop-single-product-group.html">Single Product Group</a></li>
                                    <li><a href="shop-single-product-affiliate.html">Single Product
                                            Affiliate</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:void(0)">Others Pages</a>
                                <ul>
                                    <li><a href="shop-cart.html">Shopping Cart</a></li>
                                    <li><a href="shop-checkout.html">Checkout</a></li>
                                    <li><a href="shop-wishlist.html">Wishlist</a></li>
                                    <li><a href="shop-compare.html">Compare</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">Pages</a>
                        <ul>
                            <li><a href="about-us.html">About</a></li>
                            <li><a href="account.html">Account</a></li>
                            <li><a href="login-register.html">Login/Register</a></li>
                            <li><a href="page-not-found.html">Page Not Found</a></li>
                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">Blog</a>
                        <ul>
                            <li><a href="blog.html">Blog Grid</a></li>
                            <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                            <li><a href="blog-right-sidebar.html">Blog Right Sidebar</a></li>
                            <li><a href="blog-details.html">Blog Details</a></li>
                            <li><a href="blog-details-left-sidebar.html">Blog Details Left Sidebar</a></li>
                            <li><a href="blog-details-right-sidebar.html">Blog Details Right Sidebar</a></li>
                        </ul>
                    </li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </nav>
        </div>
        <!-- End Mobile Menu Wrapper -->
    </div>
</aside> --}}
<!--== Start Side Menu ==-->

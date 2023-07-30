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
                                            <a href="{{ route('landing.post.index', $cart->associatedModel['id']) }}"><img
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
                                            <span>{{ toRupiah($cart->quantity * $cart->price) }}</span></td>
                                        <td class="product-remove"><a href="javascript:void(0);" class="remove-item"
                                                data-id="{{ $cart->id }}"><i class="fa fa-trash-o"></i></a></td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center"><h3>Tidak ada produk</h3></td>
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
                                <option>Bangladesh</option>
                                <option>Bahrain</option>
                                <option>Azerbaijan</option>
                                <option>Barbados</option>
                                <option>Barbados</option>
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
                        <a class="btn btn-link" href="shop-checkout.html">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

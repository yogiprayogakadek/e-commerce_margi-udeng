<ul>
    @forelse ($cart as $c)
        <li class="single-product-cart">
            <div class="cart-img">
                <a href="{{ route('landing.post.index', $c->associatedModel['id']) }}"><img
                        src="{{ asset($c->attributes['foto']) }}" alt="Image" width="70" height="67"></a>
            </div>
            <div class="cart-title">
                <h4><a href="{{ route('landing.post.index', $c->associatedModel['id']) }}">{{ $c->name }}
                        ({{ $c->attributes['size'] }})</a></h4>
                <span> {{ $c->quantity }} × <span class="price"> {{ toRupiah($c->price) }} </span></span>
            </div>
            <div class="cart-delete">
                <button class="btn btn-rounded btn-danger btn-remove-item text-white btn-sm" style="height: 50px;"
                    data-id="{{ $c->id }}">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
        </li>
    @empty
        <h3 class="text-center">Tidak ada produk</h3>
    @endforelse
</ul>

@if (count(cart()) > 0)
    <div class="cart-total">
        <h4>Subtotal: <span>{{cartSubTotal()}}</span></h4>
    </div>
    <div class="cart-checkout-btn">
        <a class="cart-btn" href="{{route('shopping.cart.index')}}">view cart</a>
        <a class="checkout-btn" href="shop-checkout.html">checkout</a>
    </div>
@endif

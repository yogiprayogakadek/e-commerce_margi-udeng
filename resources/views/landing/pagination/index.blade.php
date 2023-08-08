@forelse ($produk as $key => $value)
    <div class="col-sm-6 col-lg-4 mb-6">
        <!--== Start Product Item ==-->
        <div class="product-item product-item-border">
            <a class="product-thumb" href="{{ route('landing.post.index', $value->id) }}">
                <img src="{{ asset($value->foto) }}" width="300" height="286" alt="Image-HasTech">
            </a>
            {{-- <span class="badges">New</span> --}}
            <div class="product-action">
                <button type="button" class="product-action-btn action-btn-quick-view btn-modal"
                    data-id="{{ $value->id }}">
                    <i class="fa fa-expand"></i>
                </button>
            </div>
            <div class="product-info">
                <h4 class="title"><a href="{{ route('landing.post.index', $value->id) }}">{{ $value->nama }}</a>
                </h4>
                <div class="price">{!! $value->harga_terendah == $value->harga_tertinggi
                    ? toRupiah($value->harga_terendah) . '</br></br>'
                    : toRupiah($value->harga_terendah) . '-' . toRupiah($value->harga_tertinggi) !!}</div>
                <a href="{{ route('landing.post.index', $value->id) }}">
                    <button type="button" class="info-btn-wishlist">
                        <i class="fa fa-eye"></i>
                    </button>
                </a>
            </div>
        </div>
        <!--== End prPduct Item ==-->
    </div>
@empty
    <div class="section-title text-center">
        <h2 class="title">Belum ada produk</h2>
    </div>
@endforelse

<div class="d-flex justify-content-center pagination-container">
    {!! $produk->links() !!}
</div>

<section class="section" id="kids">
    <div class="container">
        <div class="section-heading"><h2>Kids' latest</h2><span>Browse available products.</span></div>
        <div class="row">
            @forelse ($productkids as $product)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="item">
                        <a href="{{ route('singleproduct', $product) }}"><img class="img-fluid" src="{{ $product->imageUrl() }}" alt="{{ $product->name }}" loading="lazy"></a>
                        <div class="down-content"><h4><a href="{{ route('singleproduct', $product) }}">{{ $product->name }}</a></h4><span>{{ $currency }} {{ number_format($product->price, 2) }}</span></div>
                    </div>
                </div>
            @empty
                <div class="col-12"><p>No kids' products are available yet.</p></div>
            @endforelse
        </div>
        {{ $productkids->links('pagination::bootstrap-4') }}
    </div>
</section>

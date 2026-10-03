<section class="section" id="product">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
            <div class="left-images">
                <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}">
            
            </div>
        </div>
        <div class="col-lg-4">
            <div class="right-content">
                <h4>{{$product->name}}</h4>
                <span class="price">{{ $currency }} {{ number_format($product->price, 2) }}</span>
                <p>{{ $product->stock > 0 ? $product->stock.' available' : 'Out of stock' }}</p>
                <ul class="stars">
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                    <li><i class="fa fa-star"></i></li>
                </ul>
                <span>{{ config('demo.enabled') ? 'This is a sample product in a read-only preview.' : 'Explore this product and add it to your cart when you are ready.' }}</span>
                <div class="quote">
                    <i class="fa fa-quote-left"></i><p>Product availability and pricing are shown above.</p>
                </div>
                <div class="total">

                    <h4>Price: {{ $currency }} {{ number_format($product->price, 2) }}</h4>
                    
                    @unless (config('demo.enabled'))
                    <div class="main-border-button">
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <label for="quantity">Quantity</label>
                            <input id="quantity" type="number" name="quantity" value="1" min="1" max="{{ min(99, $product->stock) }}" required @disabled($product->stock < 1)>
                            <button type="submit" @disabled($product->stock < 1)>Add to Cart</button>
                        </form>
                        
                    </div>
                    @endunless
                </div>
            </div>
        </div>
        </div>
    </div>
</section>


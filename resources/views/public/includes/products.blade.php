<section class="section" id="products">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Our Latest Products</h2>
                    <span>Check out all of our products.</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <form method="GET" action="{{ route('products') }}" class="row mb-4">
            <div class="col-md-5"><label for="product-search">Search products</label><input class="form-control" id="product-search" name="q" value="{{ request('q') }}" maxlength="100"></div>
            <div class="col-md-4"><label for="product-category">Category</label><select class="form-control" id="product-category" name="category"><option value="">All categories</option>@foreach ($categories as $category)<option value="{{ $category->id }}" @selected((string) request('category') === (string) $category->id)>{{ $category->category_name }}</option>@endforeach</select></div>
            <div class="col-md-3"><label>&nbsp;</label><button class="btn btn-dark form-control" type="submit">Filter</button></div>
        </form>
        <div class="row">

            @forelse ($products as $product)
            <div class="col-lg-4">     
                <div class="item">
                    <div class="thumb">
                        <div class="hover-content">
                            <ul>
                                <li><a href="{{route('singleproduct',['id' => $product->id])}}"><i class="fa fa-eye"></i></a></li>
                            </ul>
                        </div>
                        <img src="{{ $product->imageUrl() }}" alt="{{ $product->name }}">
                    </div>
                    <div class="down-content">
                        <h4>{{$product->name}}</h4>
                        <span>{{ $currency }} {{ number_format($product->price, 2) }}</span>
                    </div>
                </div>
               
            </div>
            
            @empty
                <div class="col-12"><p>No products match your search.</p></div>
            @endforelse
        </div>

        <!-- Pagination Links -->
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="Page navigation example">
                    {{ $products->links('pagination::bootstrap-4') }}
                </nav>
            </div>
        </div>
    </div>
</section>

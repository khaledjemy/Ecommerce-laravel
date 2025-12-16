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
        <div class="row">

            @foreach ($products as $product)
            <div class="col-lg-4">     
                <div class="item">
                    <div class="thumb">
                        <div class="hover-content">
                            <ul>
                                <li><a href="{{route('singleproduct',['id' => $product->id])}}"><i class="fa fa-eye"></i></a></li>
                                <li><a href=""><i class="fa fa-star"></i></a></li>
                                <li><a href=""><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <img src="{{asset('assests/images/'.$product->image)}}" alt="">
                    </div>
                    <div class="down-content">
                        <h4>{{$product->name}}</h4>
                        <span>${{$product->price}}</span>
                        <ul class="stars">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                        </ul>
                    </div>
                </div>
               
            </div>
            
            @endforeach
        </div>

        <!-- Pagination Links -->
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center mb-0">
                        {{ $products->links('pagination::bootstrap-5') }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>
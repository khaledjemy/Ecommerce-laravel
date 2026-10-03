<div class="main-banner" id="top">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-6">
                <div class="left-content">
                    <div class="thumb">
                        <div class="inner-content">
                            <h4>{{ \App\Models\StoreSetting::current()->store_name }}</h4>
                            <span>Explore our latest products.</span>
                            <div class="main-border-button">
                                <a href="{{ route('products') }}">Browse products</a>
                            </div>
                        </div>
                        <img src="{{asset('assets/images/left-banner-image.jpg')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="right-content">
                    <div class="row">
                      @foreach ($categories as $category)
                        <div class="col-lg-6">
                            <div class="right-first-image">
                                <div class="thumb">
                                    <div class="inner-content">
                                        <h4>{{$category->category_name}}</h4>
                                        <span>{{ $category->description }}</span>
                                    </div>
                                    <div class="hover-content">
                                        <div class="inner">
                                            <h4>{{$category->category_name}}</h4>
                                            <p>{{$category->description}}</p>
                                            <div class="main-border-button">
                                                <a href="{{ route('products') }}">Discover More</a>
                                            </div>
                                        </div>
                                    </div>
                                    <img src="{{ $category->imageUrl() }}" alt="{{ $category->category_name }}">
                                </div>
                            </div>
                        </div>
                        @endforeach
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main-banner" id="top">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-6">
                <div class="left-content">
                    <div class="thumb">
                        <div class="inner-content">
                            <h4>We Are Hexashop</h4>
                            <span>Awesome, clean &amp; creative HTML5 Template</span>
                            <div class="main-border-button">
                                <a href="#">Purchase Now!</a>
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
                                        <span>Best Clothes For {{$category->category_name}}</span>
                                    </div>
                                    <div class="hover-content">
                                        <div class="inner">
                                            <h4>{{$category->category_name}}</h4>
                                            <p>{{$category->description}}</p>
                                            <div class="main-border-button">
                                                <a href="#">Discover More</a>
                                            </div>
                                        </div>
                                    </div>
                                    <img src="{{asset('assests/images/'.$category->image)}}">
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
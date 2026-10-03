<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{ route('index') }}" class="logo">
                        <span style="font-size:24px;font-weight:700;color:#222">{{ \App\Models\StoreSetting::current()->store_name }}</span>
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li class="scroll-to-section"><a href="{{ route('index') }}" class="active">Home</a></li>
                        <li><a href="{{ route('index') }}#men">Men's</a></li>
                        <li><a href="{{ route('index') }}#women">Women's</a></li>
                        <li><a href="{{ route('index') }}#kids">Kid's</a></li>
                        <li class="submenu">
                            <a href="javascript:;">Pages</a>
                            <ul>
                                <li><a href="{{route('about')}}">About Us</a></li>
                                <li><a href="{{route('products')}}">Products</a></li>
                                {{-- <li><a href="{{route('singleproduct')}}">Single Product</a></li> --}}
                                <li><a href="{{route('contact')}}">Contact Us</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('index') }}#explore">Explore</a></li>
                        <li><a href="{{ route('cart.index') }}">Cart</a></li>
                    </ul>        
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>

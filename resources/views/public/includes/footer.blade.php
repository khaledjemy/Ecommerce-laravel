@php($store = \App\Models\StoreSetting::current())
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-4"><h3 style="color:white">{{ $store->store_name }}</h3><p>Browse products and contact us with your questions.</p>
                @if ($store->contact_email)<p><a href="mailto:{{ $store->contact_email }}">{{ $store->contact_email }}</a></p>@endif
            </div>
            <div class="col-lg-4"><h4>Shop</h4><ul>
                <li><a href="{{ route('products') }}">All products</a></li>
                <li><a href="{{ route('cart.index') }}">Cart</a></li>
            </ul></div>
            <div class="col-lg-4"><h4>Information</h4><ul>
                <li><a href="{{ route('index') }}">Home</a></li>
                <li><a href="{{ route('about') }}">About</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul></div>
            <div class="col-lg-12"><div class="under-footer"><p>&copy; {{ date('Y') }} {{ $store->store_name }}.<br>Design template: <a href="https://templatemo.com" target="_blank" rel="noopener noreferrer">TemplateMo</a></p></div></div>
        </div>
    </div>
</footer>

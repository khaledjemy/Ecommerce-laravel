<!DOCTYPE html>
<html lang="en">

  @include('public.includes.head')
    
    <body>
    @if (config('demo.enabled'))
        <div role="status" style="background:#fff3cd;color:#5f4300;text-align:center;padding:10px;position:relative;z-index:10000">
            Demo preview — sample products only. Ordering, messages and account changes are disabled.
        </div>
    @endif
    
    <!-- ***** Preloader Start ***** -->
    @include('public.includes.preloader')
    <!-- ***** Preloader End ***** -->
    
    
    <!-- ***** Header Area Start ***** -->
    @include('public.includes.header')
    <!-- ***** Header Area End ***** -->

     @yield('content')

    <!-- ***** Subscribe Area Ends ***** -->
      @include('public.includes.footer')
      <!-- ***** Footer Start ***** -->
      
      
      @include('public.includes.js')
   
  
    </body>
  </html>

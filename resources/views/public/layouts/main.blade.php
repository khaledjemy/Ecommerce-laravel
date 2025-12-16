<!DOCTYPE html>
<html lang="en">

  @include('public.includes.head')
    
    <body>
    
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
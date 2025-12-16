@extends('public.layouts.main')

@section('content')
    <!-- ***** Main Banner Area Start ***** -->
    @include('public.includes.mainbanner')
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** Men Area Starts ***** -->
    @include('public.includes.men')
    <!-- ***** Men Area Ends ***** -->

    <!-- ***** Women Area Starts ***** -->
    @include('public.includes.women')
    <!-- ***** Women Area Ends ***** -->

    <!-- ***** Kids Area Starts ***** -->
    @include('public.includes.kids')
    <!-- ***** Kids Area Ends ***** -->

    <!-- ***** Explore Area Starts ***** -->
    @include('public.includes.explore')
    <!-- ***** Explore Area Ends ***** -->

    <!-- ***** Social Area Starts ***** -->
    @include('public.includes.social')
    <!-- ***** Social Area Ends ***** -->

    <!-- ***** Subscribe Area Starts ***** -->
    @include('public.includes.subscribe')

    @endsection
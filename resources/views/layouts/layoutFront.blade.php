@php
$configData = Helper::appClasses();
$isFront = true;
@endphp

@section('layoutContent')

@extends('layouts/commonMaster' )

@include('layouts/sections/navbar/navbar-front')

<!-- Sections:Start -->
@yield('content')
<!-- / Sections:End -->

@include('layouts/sections/footer/footer-front')
@endsection



@extends('dome_carlow.layouts.main')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
@section('content')
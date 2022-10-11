<!DOCTYPE html>
<html>

<head>
    @include('home.css')
</head>

<body>

    @include('sweetalert::alert')

    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
        <!-- slider section -->
        @include('home.slider')
        <!-- end slider section -->
    </div>
    <!-- why section -->
    {{-- @include('home.why') --}}
    <!-- end why section -->

    <!-- arrival section -->
    {{-- @include('home.new_arrival') --}}
    <!-- end arrival section -->

    <!-- product section -->
    @include('home.product')
    <!-- end product section -->

    <!-- subscribe section -->
    {{-- @include('home.subscrib') --}}
    <!-- end subscribe section -->

    <!-- client section -->
    {{-- @include('home.client') --}}
    <!-- end client section -->
    
    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->
    @include('home.script')
</body>

</html>

<!DOCTYPE html>
<html>

<head>
    <base href="/public">

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet"> --}}

    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('home.css')

    <style>
        td img {
            width: 3rem;
            height: 3rem;
            border-radius: 5rem;
        }

        h6 {
            font-weight: bold;
        }

        input[type=search] {
            padding-left: 20px;
            padding-top: 18px;
            padding-bottom: 18px;
        }

        #search_text {

            /* border: 1px solid red; */
            /* margin-left: 10px; */
            height: 1.5rem;
            z-index: 1;
        }

        #list {
            /* padding-top:-100px;  */
            /* border: 1px solid blue; */
            margin-top: -25rem;
            /* margin-right: 150px; */
            min-width: 315px;
            position: relative;
            /* z-index: -1; */
        }

        form .btn {
            /* border: 1px solid red; */
            height: 38px;
        }
    </style>

</head>

<body>

    @include('sweetalert::alert')

    @include('home.preloader')

    <div class="hero_area2" style="margin-bottom: -4rem;z-index:1">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
    </div>


    <section class="product_section layout_padding" style="min-height: 1000px;">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Our <span>products</span>
                </h2>
            </div>
            <div class="d-flex justify-content-between" style="margin-left: 0.75rem;">
                <div class="d-flex">
                    <div class="dropdown" style="margin-right: 3rem">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Category {{ $categoryname }}
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('products') }}">All Products</a></li>
                            @foreach ($category as $category)
                                <li><a class="dropdown-item"
                                        href="{{ url('product_category', $category->category_name) }}">{{ $category->category_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Sort By {{ $sort }}
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ URL::current() . '?sort=newest' }}">Newest</a></li>
                            <li><a class="dropdown-item" href="{{ URL::current() . '?sort=name_asc' }}">Name - A to
                                    Z</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ URL::current() . '?sort=name_desc' }}">Name - Z to
                                    A</a>
                            </li>
                            <li><a class="dropdown-item" href="{{ URL::current() . '?sort=price_asc' }}">Price - Low to
                                    High</a></li>
                            <li><a class="dropdown-item" href="{{ URL::current() . '?sort=price_desc' }}">Price - High
                                    to
                                    Low</a></li>
                        </ul>
                    </div>
                </div>
                @if ($searchtext == '')
                @else
                    <div class="d-flex align-items-center">
                        <h4>Searching : {{ $searchtext }}</h4>
                    </div>
                @endif
                <form action="{{ url('searching') }}" method="GET">
                    <div id="search-form" class="d-flex" role="search">
                        <input class="form-control me-2" type="search" name="search_text" id="search_text"
                            placeholder="Search" aria-label="Search">
                        <button class="btn btn-success" type="submit" style="z-index:1;">Search</button>
                        {{ csrf_field() }}
                    </div>
                    {{-- <div class="d-flex" id="list">
                    </div> --}}
                </form>
            </div>

            <div class="d-flex justify-content-between" style="margin-left: 0.75rem;">
                <div class="d-flex">

                </div>
                <div class="d-flex">
                    <div class="d-flex justify-content-start">
                        <div id="list">
                        </div>
                    </div>
                </div>
            </div>

            @if ($product->count() == "0")
            <div class="d-flex justify-content-start" style="margin-top: 40px;margin-left: 15px">
                <h4>Not Found Data</h4>
            </div>    
            @else
                <div class="row">
                    @foreach ($product as $product)
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <div class="box">
                                <div class="option_container">
                                    <div class="options">
                                        <a href="{{ url('products', $product->id) }}" class="option1">
                                            View Product
                                        </a>
                                        <form action="{{ url('add_cart', $product->id) }}" method="POST">
                                            @csrf
                                            <input type="number" name="quantity" value="1" min="1"><br>
                                            <input type="submit" class="option2" value="Add to Cart">
                                        </form>

                                    </div>
                                </div>
                                <div class="img-box">
                                    <img src="product/{{ $product->image }}" alt="">
                                </div>
                                <div class="detail-box">
                                    <h5>
                                        {{ $product->name }}
                                    </h5>
                                    {{-- <h6 style="text-decoration:line-through;">
                                    ${{ $product->product_price }}
                                </h6> --}}
                                    <h6 style="color: red">
                                        ${{ $product->product_price }}
                                    </h6>
                                    {{-- </div> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->

    @include('home.script')


</body>

</html>

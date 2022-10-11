<!DOCTYPE html>
<html>

<head>
    <base href="/public">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">

    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
        }

        #search_text {
            /* margin-left: 10px; */
            height: 1.5rem;
            z-index: 1;
        }

        #list {
            /* border: 1px solid red; */
            margin-top: -25rem;
            /* margin-right: 150px; */
            min-width: 315px;
            position: relative;
            /* z-index: 1; */
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

    <div class="hero_area2" style="margin-bottom: -4rem">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
    </div>


    <section class="product_section layout_padding" style="min-height: 1000px">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Our <span>products</span>
                </h2>
            </div>
            <div class="d-flex justify-content-between" style="margin-left: 0.75rem;">
                <div class="d-flex">
                    <div class="dropdown" style="margin-right: 1rem">
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
                            data-bs-display="static" aria-expanded="false">
                            Sort By {{ $sort }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-lg-end">
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
        </div>
    </section>

    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->

    @include('home.script')

    <script type="text/javascript">
        $(document).ready(function() {
            $('#search_text').keyup(function() {
                var query = $(this).val();
                //   console.log(query);
                if (query != '') {
                    var _token = $('input[name="_token"]').val();
                }
                $.ajax({
                    url: "{{ route('searchproduct') }}",
                    method: "POST",
                    data: {
                        query: query,
                        _token: _token
                    },
                    success: function(data) {
                        $('#list').fadeIn();
                        $('#list').html(data);
                    }
                });
            });
        });
        $(document).on('click', 'li', function() {
            $('#list').fadeOut();
            $('#search_text').val($(this).text());
        })
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
        integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous">
    </script>

</body>

</html>

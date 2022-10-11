<!DOCTYPE html>
<html>

<head>
    <base href="/public">
    @include('home.css')
    <style>
        .aaa {
            /* margin: 0 -1rem; */
            padding: 5rem 0rem;
            width: 480px;
            min-height: 200px;
            text-align: center;
        }

        .aaa h3{
            font-weight: 700;
        }
        .aaa h4 {
            /* font-size: 28px; */
            margin-top: 2px;
            font-weight: 700;
        }

        .product_section .box .img-box2 {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: left;
            /* justify-content: center; */
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            min-height: 500px;
            /* height: 215px; */
        }

        .product_section .box .img-box2 img {
            max-width: 600px;
            max-height: 1000px;
            /* max-height: 160px;
            max-width: 100%; */
            -webkit-transition: all .3s;
            transition: all .3s;
        }

        .product_section .box:hover img {
            -webkit-transform: scale(1);
            transform: scale(1);
        }

        .product_section .box .detail-box {
            text-align: right;
            /* text-align: center; */
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            padding: 5rem 1rem;
            width: 450px;
            height: 200px;
            /* border: 1px solid red; */
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
        }

        .product_section .box .aaa h5 {
            font-size: 18px;
            margin-top: 10px;
        }

        .product_section .box .aaa .col-3 h5 {
            font-size: 18px;
            margin-top: 22.5px;
            text-decoration: line-through;
            /* border: 1px solid red; */
        }

        .product_section .box .aaa .col-3 h4 {
            /* font-size: 18px; */
            margin-top: 15px;
        }

        .product_section .box .aaa h6 {
            margin-top: 10px;
            color: #002c3e;
            font-weight: 600;
        }

        form input[type="submit"] {
            border: none;
            padding: 15px 40px;
            width: auto;
            font-size: 16px;
            text-transform: capitalize;
            line-height: normal;
            margin: 0 0;
            display: flex;
            background: #333;
            color: #fff;
            font-weight: 600;
            transition: ease all 0.1s;

        }
    </style>
</head>

<body>

    @include('sweetalert::alert')

    <div class="hero_area2">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
        <!-- slider section -->
        {{-- @include('home.slider') --}}
        <!-- end slider section -->
    </div>

    <section class="product_section" style="min-height:1200px">
        <div class="container">
            <div class="heading_container heading_center">
                <h2>
                    Our <span>products</span>
                </h2>
            </div>
            <div class="box">
                <div class="row justify-content-center">
                    <div class="img-box2">
                        <img src="product/{{ $product->image }}" alt="">
                    </div>
                    <div class="aaa">
                        {{-- justify-content-end text-left  style="border: 1px solid red"--}}
                        <div class="row justify-content-start text-left align-items-center" style="margin: 1rem; ">
                            <div class="col-2 " >
                            </div>
                            <div class="col-6 " >
                                <h3>{{ $product->name }}</h3>
                            </div>
                            <div class="col-2 " >
                                <h4 style="color: red">${{ $product->product_price }}</h4>
                            </div>
                        </div>
                        <div class="row justify-content-end text-left" style="margin: 1rem ">
                            <div class="col-4 ">
                                <h6>Category</h6>
                            </div>
                            <div class="col-6 ">
                                <h5>{{ $product->category }}</h5>
                            </div>
                        </div>
                        <div class="row justify-content-end text-left" style="margin: 1rem; ">
                            <div class="col-4 ">
                                <h6>Description</h6>
                            </div>
                            <div class="col-6 ">
                                <h5>{{ $product->description }}</h5>
                            </div>
                        </div>
                        <div class="row justify-content-end text-left" style="margin: 1rem; ">
                            <div class="col-4 ">
                                <h6>Quantity</h6>
                            </div>
                            <div class="col-6 ">
                                <h5>{{ $product->product_quantity }}</h5>
                            </div>
                        </div>


                        <form action="{{ url('add_cart', $product->id) }}" method="POST">
                            @csrf
                            <div class="row justify-content-end" style="margin: 1rem; ">
                                <div class="col-4 ">
                                    <input type="number" name="quantity" value="1" min="1">
                                </div>
                                <div class="col-6">
                                    <input type="submit" class="option2" value="Add to Cart">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->

    @include('home.script')
</body>

</html>

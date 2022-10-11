<!DOCTYPE html>
<html>

<head>
    <base href="/public">
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

        /* form input[type="submit"] {
            border: none;
            padding: 15px 35px;
            width: auto;
            font-size: 16px;
            text-transform: capitalize;
            line-height: normal;
            margin: 0 0.75rem;
            display: flex;
            background: green;
            color: #fff;
            font-weight: 600;
            transition: ease all 0.1s;
            border: 3px solid green;
            border-radius: 1%;

        } */

        /* form input[type="submit"]:hover,
        form input[type="submit"]:focus {
            background: white;
            color: green;
            border: 3px solid green;
            border-radius: 1%;
        } */
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

    <section class="cart_section">
        <div class="container-fluid">
            <div class="heading_container heading_center" style="margin-bottom: 2rem;">
                <h2>
                    <span>Cart</span>
                </h2>
            </div>

            @if ($cartcount == 0)
                <h4>Nothing in cart please pick some 
                    <a href="{{ url('products') }}" style="text-decoration: underline;">products</a>
                </h4>
            @else
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col" >#</th>
                            <th scope="col">Image</th>
                            <th scope="col" style="width: 20%">Name</th>
                            <th scope="col" style="width: 15%">Price Per Piece</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Remove</th>
                        </tr>
                    </thead>
                    <?php $totalprice = 0;
                    $totalquantity = 0; ?>
                    <tbody>
                        @foreach ($cart as $key => $cart)
                            <tr>
                                <th class="align-middle" scope="row"> {{$key+1}}</th>
                                <td><img src="/product/{{ $cart->image }}"></td>
                                <td class="align-middle">{{ $cart->product_name }}</td>
                                <td class="align-middle">${{ $cart->priceperpiece }}</td>
                                <td class="align-middle">{{ $cart->quantity }}</td>
                                <td class="align-middle">${{ $cart->price }}</td>
                                <td class="align-middle"><a class="btn btn-danger delete-confirm"
                                        href="{{ url('remove_cart', $cart->id) }}">Remove</a></td>
                            </tr>

                            <?php $totalprice = $totalprice + $cart->price;
                            $totalquantity = $totalquantity + $cart->quantity; ?>
                        @endforeach

                    </tbody>
                </table>

                <div class="row" style="">
                    <div class="col-6"></div>
                    <div class="col-6">
                        <div class="row align-items-end">
                            <div class="col-4">
                                <h6>Total Quantity : {{ $totalquantity }}</h6>
                                <input type="text" name="totalquantity" value="{{ $totalquantity }}"
                                    hidden="">
                            </div>
                            <div class="col-4">
                                <h6>Total Price : ${{ $totalprice }}</h6>
                                <input type="text" name="totalprice" value="{{ $totalprice }}" hidden="">
                            </div>
                            <div class="col-4 ">
                                <a class="btn btn-success" style="margin-right:3.25rem"
                                        href="{{ url('confirm_cart') }}">Confirm</a>
                                {{-- <input type="submit" value="Checkout"> --}}
                                {{-- <button type="submit" class="btn btn-success me-2" --}}
                                    {{-- style="padding: 0.5rem;float: right;margin-right:0.15rem" >Checkout</button>--}}

                                {{-- Check Out</input> --}}
                            </div>
                        </div>
                        {{-- <form action="{{ url('confirm_cart') }}" method="POST">
                            @csrf
                            
                        </form> --}}
                    </div>
                </div>
            @endif

        </div>
        </div>
    </section>

    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->

    @include('home.script')
    
</body>

</html>

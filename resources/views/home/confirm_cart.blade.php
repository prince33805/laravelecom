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

        .table1 {
            /* border: 1px solid red; */
            table-layout: fixed;
            white-space: normal;
            word-wrap: break-word;
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

    <section class="cart_section">
        <div class="container-fluid">
            <div class="heading_container heading_center" style="margin-bottom: 2rem;">
                <h2>Check <span>Out</span> </h2>
            </div>

            <div class="row">
                <div class="col-4">
                    <div class="table-responsive">
                        <h4>Address Infomation</h4>
                        <br>
                        <table class="table table1">
                            <tbody>
                                <tr style="">
                                    <th style="width: 40%;padding: 1.5rem;">User name</th>
                                    <td style="padding: 1.5rem;">{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $user->address }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $user->phone }}</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td><a class="btn btn-warning me-2 " href="{{ url('update_profile') }}"
                                        style="padding: 0.5rem;margin-right:0rem">Update</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-8">
                    <div class="table-responsive">
                        <h4> Order Infomation</h4>
                        <br>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col" style="width: 15%">Price Per Piece</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                </tr>
                            </tbody>
                            <?php $totalprice = 0;
                            $totalquantity = 0; ?>
                            <tbody>
                                @foreach ($cart as $key => $cart)
                                    <tr>
                                        <td class="align-middle">{{ $key + 1 }}</td>
                                        <td><img src="/product/{{ $cart->image }}"></td>
                                        <td class="align-middle">{{ $cart->product_name }}</td>
                                        <td class="align-middle">${{ $cart->priceperpiece }}</td>
                                        <td class="align-middle">{{ $cart->quantity }}</td>
                                        <td class="align-middle">${{ $cart->price }}</td>
                                    </tr>
                                    <?php $totalprice = $totalprice + $cart->price;
                                    $totalquantity = $totalquantity + $cart->quantity; ?>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <form action="{{ url('checkout') }}" method="POST">
                        @csrf
                        <div class="row align-items-end">
                            <div class="col-3"></div>
                            <div class="col-3">
                                <h6>Total Quantity : {{ $totalquantity }}</h6>
                                <input type="text" name="totalquantity" value="{{ $totalquantity }}" hidden="">
                            </div>
                            <div class="col-3">
                                <h6>Total Price : ${{ $totalprice }}</h6>
                                <input type="text" name="totalprice" value="{{ $totalprice }}" hidden="">
                            </div>
                            <div class="col-3">
                                <button type="submit" class="btn btn-success me-2">Check Out</button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>



            {{-- <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col" style="width: 15%">Price Per Piece</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Remove</th>
                        </tr>
                    </thead>
                    <?php $totalprice = 0;
                    $totalquantity = 0; ?>
                    <tbody>
                        @foreach ($cart as $cart)
                            <tr>
                                <th class="align-middle" scope="row">No.?</th>
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
                </table> --}}

            {{-- <div class="row" style="">
                    <div class="col-6"></div>
                    <div class="col-6">
                        <form action="{{ url('confirm_cart') }}" method="POST">
                            @csrf
                            <div class="row align-items-end">
                                <div class="col-4 justify-content-start">
                                    <h6>Total Quantity : {{ $totalquantity }}</h6>
                                    <input type="text" name="totalquantity" value="{{ $totalquantity }}"
                                        hidden="">
                                </div>
                                <div class="col-4">
                                    <h6>Total Price : ${{ $totalprice }}</h6>
                                    <input type="text" name="totalprice" value="{{ $totalprice }}" hidden="">
                                </div>
                                <div class="col-3">
                                    <button type="submit" class="btn btn-success me-2"></button>
                                </div>
                        </form>
                    </div>
                </div> --}}

        </div>
    </section>

    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->

    @include('home.script')

</body>

</html>

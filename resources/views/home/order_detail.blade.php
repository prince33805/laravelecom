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

        form input[type="submit"] {
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

        }

        form input[type="submit"]:hover,
        form input[type="submit"]:focus {
            background: white;
            color: green;
            border: 3px solid green;
            border-radius: 1%;
        }
    </style>

</head>

<body>
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
                <h2>Order
                    <span>Detail</span>
                </h2>
            </div>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Order Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Total Quantity</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Payment type</th>
                        <th scope="col">Delivery Status</th>
                        <th scope="col">Created At</th>
                        {{-- <th scope="col">View</th> --}}
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="align-middle" scope="row">{{ $order->id }}</td>
                        <td class="align-middle" scope="row">{{ $order->name }}</td>
                        <td class="align-middle" scope="row">{{ $order->totalquantity }}</td>
                        <td class="align-middle" scope="row">{{ $order->totalprice }}</td>
                        <td class="align-middle" scope="row">{{ $order->paymenytype }}</td>
                        <td class="align-middle" scope="row">{{ $order->deliverystatus }}</td>
                        <td class="align-middle" scope="row">{{ $order->created_at }}</td>
                        {{-- <td class="align-middle"><a class="btn btn-warning"
                                href="{{ url('orders', $order->id) }}">View</a></td> --}}
                    </tr>
                </tbody>
            </table>

            <br>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Order Id</th>
                        <th scope="col">Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price Per Piece</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderitem as $orderitem)
                        <tr>
                            <td class="align-middle" scope="row">{{ $orderitem->order_id }}</td>
                            <td> <img src="/product/{{ $orderitem->image }}"></td>
                            <td class="align-middle" scope="row">{{ $orderitem->product_name }}</td>
                            <td class="align-middle" scope="row">{{ $orderitem->quantity }}</td>
                            <td class="align-middle" scope="row">{{ $orderitem->priceperpiece }}</td>
                            <td class="align-middle" scope="row">{{ $orderitem->price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        </div>
    </section>

    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->

    @include('home.script')
</body>

</html>

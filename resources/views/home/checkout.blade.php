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

        .col-6 .btn {
            padding: 2.5px 20px;
            margin-left: 9.5rem;
            /* justify-content:end0; */
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
                <h2>
                    <span>Check Out</span>
                </h2>
            </div>
            <div class="col-6">
                <h4 style="margin-bottom: 20px;">Delivery Information</h4>
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th class="align-middle" style="width: 50%" scope="row">Name</th>
                            <td class="align-middle">{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th class="align-middle" scope="row">Email</th>
                            <td class="align-middle">{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th class="align-middle" scope="row">Address</th>
                            <td class="align-middle">{{ $user->address }}</td>
                        </tr>
                        <tr>
                            <th class="align-middle" scope="row">Phone</th>
                            <td class="align-middle">{{ $user->phone }}</td>
                        </tr>
                    </tbody>
                </table>
                <a class="btn btn-warning" href="{{ url('redirect') }}">Edit</a>
            </div>
            <div class="col-6"></div>

            {{-- <div class="row" style="">
                <div class="col-6"></div>
                <div class="col-6">
                    <form action="{{ url('confirm_cart') }}" method="POST">
                        @csrf
                        <div class="row align-items-end">
                            <div class="col-4 justify-content-start">
                                <h6>Total Quantity : {{ $totalquantity }}</h6>
                                <input type="text" name="totalquantity" value="{{ $totalquantity }}" hidden="">
                            </div>
                            <div class="col-4">
                                <h6>Total Price : ${{ $totalprice }}</h6>
                                <input type="text" name="totalprice" value="{{ $totalprice }}" hidden="">
                            </div>
                            <div class="col-3">
                                <input type="submit" value="Checkout">
                            </div>
                    </form>
                </div>
            </div> --}}
        </div>
        </div>
    </section>

    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->

    @include('home.script')
</body>

</html>

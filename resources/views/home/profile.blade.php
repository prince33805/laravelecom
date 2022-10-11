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
                <h2>Profile
                    {{-- <span>Detail</span> --}}
                </h2>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <th style="padding:2rem;" scope="row">User Id</th>
                            <td style="padding:2rem;">{{ $user->id }}</td>
                            <th style="padding:2rem;" scope="row">User Name</th>
                            <td style="padding:2rem;">{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th style="padding:2rem;" scope="row">Phone</th>
                            <td style="padding:2rem;">{{ $user->phone }}</td>
                            <th style="padding:2rem;" scope="row">Email</th>
                            <td style="padding:2rem;">{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th style="padding:2rem;" scope="row">Address</th>
                            <td style="padding:2rem;">{{ $user->address }}</td>
                            <th style="padding:2rem;" scope="row">Creted At</th>
                            <td style="padding:2rem;">{{ $user->created_at }}</td>
                        </tr>
                        <tr>
                            <th></th>
                            <td></td>
                            <th></th>
                            <td></td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-8"></div>
                <div class="col-4">
                    <a class="btn btn-warning me-2 " href="{{ url('update_profile') }}"
                        style="padding: 0.5rem;">Update</a>        
                </div>
            </div>
            <br>
            {{-- <div class="table-responsive">
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
                        @foreach ($useritem as $useritem)
                            <tr>
                                <td class="align-middle" scope="row">{{ $useritem->order_id }}</td>
                                <td class="align-middle" scope="row">Img</td>
                                <td class="align-middle" scope="row">{{ $useritem->product_name }}</td>
                                <td class="align-middle" scope="row">{{ $useritem->quantity }}</td>
                                <td class="align-middle" scope="row">{{ $useritem->priceperpiece }}</td>
                                <td class="align-middle" scope="row">{{ $useritem->price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> --}}
        </div>
    </section>

    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->

    @include('home.script')
</body>

</html>

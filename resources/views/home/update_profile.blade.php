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

        label {
            float: left;
            font-size: 20px;
            font-weight: bold;

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
                <h2>Update
                    <span>Profile</span>
                </h2>
            </div>
            <form class="forms-sample" action="{{ url('/update_profile_confirm') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="row" style="margin-bottom: -10px;">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>User Name</label>
                            <input type="text" class="form-control" placeholder="Product Name" name="name"
                                required value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" style="text-transform:lowercase"
                                placeholder="Product Name" name="email" required value="{{ $user->email }}">
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control" placeholder="Product Name" name="address"
                                required value="{{ $user->address }}">
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" placeholder="Product Name" name="phone"
                                required value="{{ $user->phone }}">
                        </div>
                    </div>
                </div>
                @if (session()->has('message'))
                    <br>
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                            X
                        </button>
                    </div>
                @endif
                <br>
                <div class="row">
                    <div class="col-10"></div>
                    <div class="col-1">
                        <button type="submit" class="btn btn-success me-2" style="padding: 0.5rem">Submit</button>
                        {{-- <a class="btn btn-success me-2 " href="{{ url('update_profile_confirm', $user->id) }}"
                            style="padding: 0.5rem;">Save</a> --}}
                    </div>
                    <div class="col-1">
                        <a class="btn btn-secondary me-2 " href="{{ url('profile') }}"
                            style="padding: 0.5rem;">Cancel</a>
                    </div>
                </div>
            </form>

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

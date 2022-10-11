<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('admin.css')
    <style>
        .card .card-body {
            padding-top: 1.25rem;
            padding-left: 1.5625rem;
            padding-right: 1.5625rem;
            padding-bottom: 0.5rem;
        }

        .a {
            white-space: normal;
            word-wrap: break-word;
            line-height: 1.6;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.header')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    {{-- <div class="page-header"> --}}
                    <h3 class="page-title"> Supplier </h3>
                    {{-- </div> --}}
                    <div class="row justify-content-center">
                        <div class="col-lg-10 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Supplier : {{ $data->name }}</h4>
                                    {{-- <div class="table"> --}}
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Id</th>
                                                    <td>{{ $data->id }}</td>
                                                    <th scope="row">Address</th>
                                                    <td>{{ $data->address }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Supplier Name</th>
                                                    <td>{{ $data->name }}</td>
                                                    <th scope="row">Description</th>
                                                    <td style="width:50%" rowspan="2">
                                                        <div class="a">
                                                            {{ $data->description }}
                                                        </div>
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <th scope="row">Phone</th>
                                                    <td>{{ $data->phone }}</td>
                                                    {{-- <th scope="row"></th>
                                                    <td></td> --}}
                                                </tr>
                                                {{-- <tr>
                                                    <th></th>
                                                    <td></td>
                                                    <th></th>
                                                    <td></td>
                                                </tr> --}}

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-10 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="card-title">Product</h4>
                                        {{-- <form class="d-flex" role="search" style="margin-right:4.75rem"
                                            action="{{ url('search') }}" method="get">
                                            <input class="form-control me-2" name="search" type="search"
                                                placeholder="Search" aria-label="Search">
                                            <button class="btn btn-outline-success" type="submit"
                                                style="padding: 0.5rem;">Search</button>
                                        </form> --}}
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Name</th>
                                                    <th>Supplier</th>
                                                    <th>Buy Price</th>
                                                    <th>Price</th>
                                                    <th>Discount Price</th>
                                                    <th>Quantity</th>
                                                    <th>Image</th>
                                                    <th>View</th>
                                                    <th>Update</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($product as $product)
                                                    <tr>
                                                        <td>{{ $product->id }}</td>
                                                        <td>{{ $product->name }}</td>
                                                        <td>{{ $product->supplier }}</td>
                                                        <td>{{ $product->buy_price }}</td>
                                                        <td>{{ $product->product_price }}</td>
                                                        <td>{{ $product->discount_price }}</td>
                                                        <td>{{ $product->product_quantity }}</td>
                                                        <td> <img src="/product/{{ $product->image }}"></td>
                                                        <td><a class="btn btn-primary me-2"
                                                                href="{{ url('all_product', $product->id) }}"
                                                                style="padding: 0.5rem">View</a>
                                                        </td>
                                                        <td><a class="btn btn-warning me-2"
                                                                href="{{ url('update_product', $product->id) }}"
                                                                style="padding: 0.5rem">Update</a>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @if (session()->has('deletemessage'))
                                        <br>
                                        <div class="alert alert-success" role="alert">
                                            {{ session()->get('deletemessage') }}
                                            <button type="button" class="close" product-dismiss="alert"
                                                aria-hidden="true">
                                                X
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- partial:partials/_footer.html -->
                @include('admin.footer')
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.script')
</body>

</html>

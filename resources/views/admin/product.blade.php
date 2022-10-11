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
                    <h3 class="page-title"> Product </h3>
                    {{-- </div> --}}
                    <div class="row justify-content-center">
                        <div class="col-lg-10 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Product : {{ $product->name }}</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th scope="row" style="width: 25%">Id</th>
                                                    <td style="width: 25%">{{ $product->id }}</td>
                                                    <th scope="row" style="width: 50%">Image</th>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Name</th>
                                                    <td>{{ $product->name }}</td>
                                                    <td rowspan="8">
                                                        <img src="/product/{{ $product->image }}"
                                                            style="width: 25rem;height:25rem;
                                                            margin: auto;display: block;border-radius:0%;">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Supplier</th>
                                                    <td>{{ $product->supplier }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Category</th>
                                                    <td>{{ $product->category }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Buy Price</th>
                                                    <td>{{ $product->buy_price }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Price</th>
                                                    <td>{{ $product->product_price }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Discount Price</th>
                                                    <td>{{ $product->discount_price }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Quantity</th>
                                                    <td>{{ $product->product_quantity }}</td>
                                                </tr>
                                                <tr>
                                                    <td><a class="btn btn-warning me-2"
                                                            href="{{ url('update_product', $product->id) }}"
                                                            style="padding: 0.5rem">Update</a>
                                                    </td>
                                                    <td><a class="btn btn-danger me-2"
                                                            href="{{ url('products', $product->id) }}"
                                                            style="padding: 0.5rem">Delete</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
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

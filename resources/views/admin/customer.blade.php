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
                    <h3 class="page-title"> Customer </h3>
                    {{-- </div> --}}
                    <div class="row justify-content-center">
                        <div class="col-lg-10 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Customer : {{ $customer->name }}</h4>
                                    <div class="table-responsive">
                                        <table class="table" {{-- style="margin-bottom: -0rem" --}}>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Id</th>
                                                    <td>{{ $customer->id }}</td>
                                                    <th scope="row">Supplier Name</th>
                                                    <td>{{ $customer->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Address</th>
                                                    <td>{{ $customer->address }}</td>
                                                    <th scope="row">Phone</th>
                                                    <td>{{ $customer->phone }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Creted At</th>
                                                    <td>{{ $customer->created_at }}</td>
                                                    <th scope="row"></th>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">

                        <div class="col-lg-10 grid-margin stretch-card ">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Order</h4>

                                    <div class="table-responsive text-center">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Order Id</th>
                                                    <th>User Id</th>
                                                    <th>User Name</th>
                                                    <th>Total Quantity</th>
                                                    <th>Total Price</th>
                                                    <th>Payment Status</th>
                                                    <th>Delivery Status</th>
                                                    <th>View</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order as $order)
                                                    <tr>
                                                        <td>{{ $order->id }}</td>
                                                        <td>{{ $order->user_id }}</td>
                                                        <td>{{ $order->name }}</td>
                                                        <td>{{ $order->totalquantity }}</td>
                                                        <td>{{ $order->totalprice }}</td>
                                                        <td>{{ $order->paymenystatus }}</td>
                                                        <td>{{ $order->deliverystatus }}</td>
                                                        <td>
                                                            <a class="btn btn-primary"
                                                                href="{{ url('order', $order->id) }}"
                                                                style="padding:0.5rem 1rem;margin:0">View</a>
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
                                            <button type="button" class="close" order-dismiss="alert"
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

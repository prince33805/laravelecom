<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style>

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
                    <h3 class="page-title"> Order </h3>
                    {{-- </div> --}}
                    <div class="row justify-content-center">

                        <div class="col-lg-10 grid-margin stretch-card ">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">All Order</h4>

                                    <div class="table-responsive text-center">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>User Id</th>
                                                    <th>User Name</th>
                                                    <th>Total Quantity</th>
                                                    <th>Total Price</th>
                                                    <th>Payment Status</th>
                                                    <th>Delivery Status</th>
                                                    <th>Update</th>
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
                                                            @if ($order->deliverystatus == 'pending')
                                                                <a class="btn btn-warning me-2 "
                                                                    href="{{ url('delivered', $order->id) }}"
                                                                    onclick="return confirm('Are you sure this product is delivered ?')"
                                                                    style="padding:0.5rem 1rem;margin:0">Deliverd</a>
                                                            @else
                                                                <a class="btn btn-secondary me-2 disabled"
                                                                    {{-- href="{{ url('deliverd', $order->id) }}" --}}
                                                                    style="padding:0.5rem 1rem;margin:0">Deliverd</a>
                                                            @endif
                                                        </td>
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

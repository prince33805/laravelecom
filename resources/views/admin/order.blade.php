<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('admin.css')
    <style>
        .card .card-body {
            /* padding: 1.75rem 1.5625rem;  */
            padding-top: 1.25rem;
            padding-left: 1.5625rem;
            padding-right: 1.5625rem;
            padding-bottom: 0rem;
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
                    <h3 class="page-title"> Order </h3>
                    {{-- </div> --}}
                    <div class="row justify-content-center">
                        <div class="col-lg-10 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Order Id : {{ $order->id }}</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th style="padding-left: 5rem;" scope="row">Order Id</th>
                                                    <td style="padding-left: 5rem;">{{ $order->id }}</td>
                                                    <th style="padding-left: 5rem;" scope="row">User Id</th>
                                                    <td style="padding-left: 5rem;">{{ $order->user_id }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding-left: 5rem;" scope="row">User Name</th>
                                                    <td style="padding-left: 5rem;">{{ $order->name }}</td>
                                                    <th style="padding-left: 5rem;" scope="row">Email</th>
                                                    <td style="padding-left: 5rem;">{{ $order->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding-left: 5rem;" scope="row">Address</th>
                                                    <td style="padding-left: 5rem;">{{ $order->address }}</td>
                                                    <th style="padding-left: 5rem;" scope="row">Phone</th>
                                                    <td style="padding-left: 5rem;">{{ $order->phone }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding-left: 5rem;" scope="row">Total Quantity</th>
                                                    <td style="padding-left: 5rem;">{{ $order->totalquantity }}</td>
                                                    <th style="padding-left: 5rem;" scope="row">Total Price</th>
                                                    <td style="padding-left: 5rem;">{{ $order->totalprice }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding-left: 5rem;" scope="row">Payment Type</th>
                                                    <td style="padding-left: 5rem;">{{ $order->paymenytype }}</td>
                                                    <th style="padding-left: 5rem;" scope="row">Payment Status</th>
                                                    <td style="padding-left: 5rem;">{{ $order->paymenystatus }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding-left: 5rem;"scope="row">Delivery Status</th>
                                                    <td style="padding-left: 5rem;">{{ $order->deliverystatus }}
                                                        @if ($order->deliverystatus == 'pending')
                                                            <a class="btn btn-success me-2 "
                                                                href="{{ url('delivered', $order->id) }}"
                                                                onclick="return confirm('Are you sure this product is delivered ?')"
                                                                style="padding: 0.5rem; margin-left:1rem">Deliverd</a>
                                                        @else
                                                            <a class="btn btn-secondary me-2 disabled"
                                                                {{-- href="{{ url('deliverd', $order->id) }}" --}}
                                                                style="padding: 0.5rem; margin-left:1rem">deliverd</a>
                                                        @endif
                                                    </td>
                                                    <th style="padding-left: 5rem;" scope="row">Created At</th>
                                                    <td style="padding-left: 5rem;">{{ $order->created_at }}</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding-left: 5rem;" scope="row"></th>
                                                    <td style="padding-left: 5rem;">
                                                        <a class="btn btn-warning me-2 "
                                                            href="{{ url('send_email', $order->id) }}"
                                                            style="padding: 0.5rem;">Send Email</a>
                                                    </td>
                                                    <td style="padding-left: 5rem;">
                                                        {{-- <a class="btn btn-primary me-2 "
                                                            href="{{ url('pdf', $order->id) }}"
                                                            style="padding: 0.5rem;">View PDF</a> --}}
                                                    </td>
                                                    <td style="padding-left: 5rem;">
                                                        <a class="btn btn-primary me-2 "
                                                            href="{{ url('print_pdf', $order->id) }}"
                                                            style="padding: 0.5rem;">Print PDF</a>
                                                    </td>
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
                                    <h4 class="card-title">Order Detail </h4>

                                    <div class="table-responsive text-center">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Order Id</th>
                                                    <th>Product Id</th>
                                                    <th>Product Image</th>
                                                    <th>Product Name</th>
                                                    <th>Quantity</th>
                                                    <th>Price Per Piece</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orderproduct as $orderproduct)
                                                    <tr>
                                                        <td>{{ $orderproduct->order_id }}</td>
                                                        <td>{{ $orderproduct->product_id }}</td>
                                                        <td> <img src="/product/{{ $orderproduct->image }}"></td>
                                                        <td>{{ $orderproduct->product_name }}</td>
                                                        <td>{{ $orderproduct->quantity }}</td>
                                                        <td>{{ $orderproduct->priceperpiece }}</td>
                                                        <td>{{ $orderproduct->price }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- @if (session()->has('deletemessage'))
                                        <br>
                                        <div class="alert alert-success" role="alert">
                                            {{ session()->get('deletemessage') }}
                                            <button type="button" class="close" order-dismiss="alert"
                                                aria-hidden="true">
                                                X
                                            </button>
                                        </div>
                                    @endif --}}
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

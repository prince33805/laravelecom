<!DOCTYPE html>
<html lang="en">

<head>
    <title>Order PDF</title>
    <style>
        table,
        td,
        th {
            border: 1px solid;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        img {
            width: 30px;
            height: 30px;
            border-radius: 100%;
        }
    </style>
</head>

<body>
    <div class="main-panel" style="margin: auto;">
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
                                            <th scope="row">Order Id</th>
                                            <td>{{ $order->id }}</td>
                                            <th scope="row">User Id</th>
                                            <td>{{ $order->user_id }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">User Name</th>
                                            <td>{{ $order->name }}</td>
                                            <th scope="row">Email</th>
                                            <td>{{ $order->email }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Address</th>
                                            <td>{{ $order->address }}</td>
                                            <th scope="row">Phone</th>
                                            <td>{{ $order->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Total Quantity</th>
                                            <td>{{ $order->totalquantity }}</td>
                                            <th scope="row">Total Price</th>
                                            <td>{{ $order->totalprice }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Payment Type</th>
                                            <td>{{ $order->paymenytype }}</td>
                                            <th scope="row">Created At</th>
                                            <td>{{ $order->created_at }}</td>
                                        </tr>

                                        {{-- <tr>
                                            <th  scope="row">Delivery Status</th>
                                            <td  >{{ $order->deliverystatus }}
                                                @if ($order->deliverystatus == 'pending')
                                                    <a class="btn btn-success me-2 "
                                                        href="{{ url('delivered', $order->id) }}"
                                                        onclick="return confirm('Are you sure this product is delivered ?')"
                                                        style="padding: 0.5rem; margin-left:1rem">Deliverd</a>
                                                @else
                                                    <a class="btn btn-secondary me-2 disabled"
                                                        style="padding: 0.5rem; margin-left:1rem">deliverd</a>
                                                @endif
                                            </td>
                                            <th   scope="row">Payment Status</th>
                                            <td  >{{ $order->paymenystatus }}</td>
                                        </tr> --}}
                                        {{-- <tr>
                                            <th   scope="row"></th>
                                            <td  >
                                                <a class="btn btn-warning me-2 "
                                                    href="{{ url('send_email', $order->id) }}"
                                                    style="padding: 0.5rem;">Send Email</a>
                                            </td>
                                            <td  >
                                                <a class="btn btn-primary me-2 "
                                                    href="{{ url('pdf', $order->id) }}"
                                                    style="padding: 0.5rem;">View PDF</a>
                                            </td>
                                            <td  >
                                                <a class="btn btn-primary me-2 "
                                                    href="{{ url('print_pdf', $order->id) }}"
                                                    style="padding: 0.5rem;">Print PDF</a>
                                            </td>
                                        </tr> --}}
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
                                                {{-- <td><img src="/product/{{ $orderproduct->image }}"></td> --}}
                                                <td><img src="{{ public_path('/product/' . $orderproduct->image) }}"
                                                        alt=""></td>
                                                <td>{{ $orderproduct->product_name }}</td>
                                                <td>{{ $orderproduct->quantity }}</td>
                                                <td>{{ $orderproduct->priceperpiece }}</td>
                                                <td>{{ $orderproduct->price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</body>

</html>

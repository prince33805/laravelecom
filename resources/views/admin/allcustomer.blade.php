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
                    <h3 class="page-title"> Customer </h3>
                    {{-- </div> --}}
                    <div class="row justify-content-center">

                        <div class="col-lg-10 grid-margin stretch-card ">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">All Customer</h4>

                                    <div class="table-responsive text-center">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>User Id</th>
                                                    <th>User Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>Created At</th>
                                                    <th>View</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($customer as $customer)
                                                    <tr>
                                                        <td>{{ $customer->id }}</td>
                                                        <td>{{ $customer->name }}</td>
                                                        <td>{{ $customer->email }}</td>
                                                        <td>{{ $customer->phone }}</td>
                                                        <td>{{ $customer->created_at }}</td>
                                                        {{-- <td>
                                                            @if ($customer->deliverystatus == 'pending')
                                                                <a class="btn btn-warning me-2 "
                                                                    href="{{ url('delivered', $customer->id) }}"
                                                                    onclick="return confirm('Are you sure this product is delivered ?')"
                                                                    style="padding:0.5rem 1rem;margin:0">Deliverd</a>
                                                            @else
                                                                <a class="btn btn-secondary me-2 disabled"
                                                                    style="padding:0.5rem 1rem;margin:0">Deliverd</a>
                                                            @endif
                                                        </td> --}}
                                                        <td>
                                                            <a class="btn btn-primary"
                                                                href="{{ url('customer', $customer->id) }}"
                                                                style="padding:0.5rem 1rem;margin:0">View</a>
                                                        </td>

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

<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style>
        /* .btn{
            padding: 1px;
        } */
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
                        <div class="col-md-4 grid-margin ">
                            <div class="card">
                                <div class="card-body" style="padding-bottom: 1rem">
                                    <h4 class="card-title">Add Supplier</h4>
                                    {{-- <p class="card-description"> Basic form layout </p> --}}
                                    <form class="forms-sample" action="{{ url('/add_supplier') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="exampleInputUsername1">Supplier Name</label>
                                                    <input type="text" class="form-control"
                                                        id="exampleInputUsername1" name="name"
                                                        placeholder="Supplier Name">
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="form-group">
                                                    <label for="exampleInputUsername1">Address</label>
                                                    <input type="text" class="form-control"
                                                        id="exampleInputUsername1" name="address" placeholder="Address">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <label for="exampleInputUsername1">Phone</label>
                                                    <input type="text" class="form-control"
                                                        id="exampleInputUsername1" name="phone" placeholder="Phone">
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="form-group">
                                                    <label for="exampleInputUsername1">Description</label>
                                                    <input type="text" class="form-control"
                                                        id="exampleInputUsername1" name="description"
                                                        placeholder="Description">
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary me-2"
                                            style="padding: 0.375rem 2rem;">Submit</button>
                                    </form>
                                </div>
                                @if (session()->has('addmessage'))
                                    <div class="alert alert-success" style="margin-top: 1rem;padding-left:25px"
                                        role="alert">
                                        {{ session()->get('addmessage') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                            X
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body" style="padding-bottom: 0rem">
                                    <h4 class="card-title">All Supplier</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Name</th>
                                                    <th>Phone</th>
                                                    <th>View</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $data)
                                                    <tr>
                                                        <td>{{ $data->id }}</td>
                                                        <td style="width: 35%">{{ $data->name }}</td>
                                                        <td style="width: 25%">{{ $data->phone }}</td>
                                                        <td style="width: 25%"><a type="button" class="btn btn-warning btn-fw"
                                                                style="padding: 0.375rem 2rem;"
                                                                href="{{ url('supplier', $data->id) }}">View</a>
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

<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
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
                    <h3 class="page-title"> Catagory </h3>
                    {{-- </div> --}}
                    <div class="row justify-content-center">
                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card" style="height: 190px">
                                <div class="card-body">
                                    <h4 class="card-title">Add Category</h4>
                                    {{-- <p class="card-description"> Basic form layout </p> --}}
                                    <form class="forms-sample" action="{{ url('/add_category') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Category Name</label>
                                            <input type="text" class="form-control" id="exampleInputUsername1"
                                                name="category_name" placeholder="Category Name">
                                        </div>
                                        <button type="submit" class="btn btn-primary me-2" style="padding: 0.375rem 2rem;">Submit</button>
                                    </form>
                                </div>
                                <br>
                                @if (session()->has('addmessage'))
                                    <div class="alert alert-success" style="margin-top: 155px;padding-left:25px" role="alert">
                                        {{ session()->get('addmessage') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                            X
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-lg-6 stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">All Category</h4>
                                    {{-- <p class="card-description"> Add class <code>.table</code>
                                    </p> --}}
                                    <div class="table-responsive" >
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>View</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $data)
                                                    <tr>
                                                        <td>{{$data->id}}</td>
                                                        <td>{{ $data->category_name }}</td>
                                                        <td><a type="button" class="btn btn-warning btn-fw"
                                                            style="padding: 0.375rem 1rem;"
                                                                href="{{ url('category', $data->id) }}">View</a>
                                                        </td>
                                                        <td><a type="button" class="btn btn-danger btn-fw"
                                                            style="padding: 0.375rem 1rem;"
                                                                onclick="return confirm('Are you sure to Delete ?')"
                                                                href="{{ url('delete_category', $data->id) }}">Delete</a>
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

                    <div class="row justify-content-center">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-6">
                            @if (session()->has('deletemessage'))
                                    <div class="alert alert-success" style="margin-top: 15px ;padding-left:35px" role="alert">
                                        {{ session()->get('deletemessage') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                            X
                                        </button>
                                    </div>
                                @endif
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

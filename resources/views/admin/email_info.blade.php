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
                    <h3 class="page-title"> Email </h3>
                    {{-- </div> --}}
                    <div class="row justify-content-center">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body" style="margin-bottom: 1rem">
                                    <h4 class="card-title">Sending Email to {{$order->email}}</h4>
                                    {{-- <p class="card-description"> Basic form layout </p> --}}
                                    <form class="forms-sample" action="{{ url('/send_user_email', $order->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputUsername1">Email Greeting</label>
                                            <input type="text" class="form-control" placeholder="Hello from ...."
                                                name="greeting" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email Firstline</label>
                                            <input type="text" class="form-control" placeholder="Good Day"
                                                name="firstline" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email Body</label>
                                            <input type="text" class="form-control" placeholder="Email Notification"
                                                name="body" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email Button name</label>
                                            <input type="text" class="form-control" placeholder="Click Me"
                                                name="button" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email Url</label>
                                            <input type="text" class="form-control" placeholder="Url"
                                                name="url" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email Last Line</label>
                                            <input type="text" class="form-control" placeholder="Thank You"
                                                name="lastline" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary me-2"
                                            style="padding: 0.5rem;float: left">Submit</button>


                                        @if (session()->has('message'))
                                            <br>
                                            <div class="alert alert-success" role="alert">
                                                {{ session()->get('message') }}
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-hidden="true">
                                                    X
                                                </button>
                                            </div>
                                        @endif
                                    </form>
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

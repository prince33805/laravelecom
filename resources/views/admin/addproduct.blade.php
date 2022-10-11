option
<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <style>
        .aaa {
            border: 1px solid #2c2e33;
            height: calc(2.25rem + 2px);
            font-weight: normal;
            font-size: 0.875rem;
            padding: 0.56rem 0.75rem;
            background-color: #2A3038;
            border-radius: 2px;
            color: white;
            width: 100%;
            padding-left: 8px;
        }

        .bbb {
            border: 1px solid #2c2e33;
            height: calc(2.25rem + 2px);
            font-weight: normal;
            font-size: 0.875rem;
            padding: 0.625rem 0.6875rem;
            background-color: #2A3038;
            border-radius: 2px;
            color: white;
            width: 100%;

            position: relative;
        }

        select:invalid {
            color: #6c7293;
            padding-left: 8px;
        }

        .inputfile-box {
            /* position: relative; */
        }

        .inputfile {
            display: none;
        }

        .container {
            display: inline-block;
            width: 100%;
        }

        .file-box {
            background-color: #2A3038;
            display: block;
            height: calc(2rem + 2px);
            width: 50%;
            /* border: 1px solid red; */
            padding: 0.625rem 0.6875rem;
            border-radius: 2px;
            box-sizing: border-box;
            position: absolute;
            top: 0.1rem;
            left: 0rem;
        }

        .file-button {
            display: block;
            background: #2A3038;
            padding: 0.625rem 0.6875rem;
            border-radius: 2px;
            border: 0.5px solid;
            position: absolute;
            top: 0rem;
            right: 0rem;
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
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body" style="margin-bottom: -1.5rem;">
                                    <h4 class="card-title">Add Product</h4>
                                    {{-- <p class="card-description"> Basic form layout </p> --}}
                                    <form class="forms-sample" action="{{ url('/upload_product') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row" style="margin-bottom: -10px;">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputUsername1">Product Name</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Product Name" name="name" required>
                                                </div>
                                                <div class="inline-block relative w-64 " style="padding-bottom:1rem">
                                                    <label
                                                        style="font-size: 0.875rem;
                                                    line-height: 1;
                                                    vertical-align: top;">Product
                                                        Supplier</label>
                                                    <select required name="supplier" class="aaa">
                                                        <option value="" disabled selected hidden>Choose Supplier
                                                        </option>
                                                        @foreach ($supplier as $supplier)
                                                            <option value="{{ $supplier->name }}">
                                                                {{ $supplier->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Product Description</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Product Description" name="description" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Buy Price</label>
                                                    <input type="number" class="form-control" placeholder="Buy Price"
                                                        name="buy_price" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Price</label>
                                                    <input type="number" class="form-control" placeholder="Price"
                                                        name="price" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Discount Price</label>
                                                    <input type="number" class="form-control"
                                                        placeholder="Discount Price" name="discount_price" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Quantity</label>
                                                    <input type="number" class="form-control" placeholder="Quantity"
                                                        name="quantity" required>
                                                </div>
                                                <div class="inline-block relative w-64 " style="padding-bottom:1rem">
                                                    <label
                                                        style="font-size: 0.875rem;line-height: 1;
                                                        vertical-align: top;">Product
                                                        Category</label>
                                                    <select required name="category[]" class="aaa" multiple=""
                                                        style="height: 114px">
                                                        @foreach ($category as $category)
                                                            <option value="{{ $category->category_name }}">
                                                                {{ $category->category_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Product Image</label>
                                                    <div class="bbb">
                                                        <div class="inputfile-box">
                                                            <input type="file" id="file" class="inputfile"
                                                                name="image" required onchange='uploadFile(this)'>
                                                            <label for="file">
                                                                <span class="file-button">
                                                                    <i class="fa fa-upload" aria-hidden="true"></i>
                                                                    Select File
                                                                </span>
                                                                <span class="file-box" id="file-name"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-11 align-items-center" >
                                                @if (session()->has('message'))
                                                    <div class="alert alert-success" role="alert">
                                                        {{ session()->get('message') }}
                                                        <button type="button" class="close" data-dismiss="alert"
                                                            aria-hidden="true">
                                                            X
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-1 align-self-center" >
                                                <button type="submit" class="btn btn-primary me-2"
                                                    style="padding: 0.5rem;float: right;margin-right:0.15rem;margin-bottom:1rem;">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="col-lg-4 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">All Category</h4>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Name</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $data)
                                                    <tr>
                                                        <td>No</td>
                                                        <td>{{ $data->category_name }}</td>
                                                        <td><a type="button" class="btn btn-danger btn-fw"
                                                                onclick="return confirm('Are you sure to Delete ?')"
                                                                href="{{ url('delete_category', $data->id) }}">Delete</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @if (session()->has('deletemessage'))
                                        <br>
                                        <div class="alert alert-success" role="alert">{{ session()->get('deletemessage') }}
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-hidden="true">
                                                X
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div> --}}

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
    <script>
        function uploadFile(target) {
            document.getElementById("file-name").innerHTML = target.files[0].name;
        }
    </script>
</body>

</html>

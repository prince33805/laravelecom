option
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
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
            /* padding: 0.625rem 0.6875rem; */
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
            /* border: 1px solid red; */
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
            /* border: 1px solid green; */
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
            z-index: 1;
            /* margin-top: 10px;  */
            padding: 0.625rem 0.6875rem;
            border-radius: 2px;
            border: 0.5px solid;
            position: absolute;
            top: 0rem;
            right: 0rem;
        }

        .ccc {
            /* border: 1px solid red; */
            /* margin: 2rem; */
            position: absolute;
            bottom: 0rem;
            right: 5.15rem;
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
                        <div class="col-md-8 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Update Product ID : {{ $product->id }} </h4>
                                    {{-- <p class="card-description"> Basic form layout </p> --}}
                                    <form class="forms-sample"
                                        action="{{ url('/update_product_confirm', $product->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row" style="margin-bottom: -10px;">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="exampleInputUsername1">Product Name</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Product Name" name="name" required
                                                        value="{{ $product->name }}">
                                                </div>
                                                <div class="inline-block relative w-64 " style="padding-bottom:1rem">
                                                    <label
                                                        style="font-size: 0.875rem;
                                                    line-height: 1;
                                                    vertical-align: top;">Product
                                                        Supplier</label>
                                                    <select required name="supplier" class="aaa">
                                                        <option value="" selected disabled hidden>
                                                            {{ $product->supplier }}
                                                        </option>
                                                        @foreach ($supplier as $supplier)
                                                            <option value="{{ $supplier->name }}"
                                                                {{-- @selected(old('supplier') == $supplier->name)  --}}
                                                                >{{ $supplier->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Product Description</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Product Description" name="description" required
                                                        value="{{ $product->description }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Buy Price</label>
                                                    <input type="number" class="form-control" placeholder="Buy Price"
                                                        name="buy_price" required value="{{ $product->buy_price }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Price</label>
                                                    <input type="number" class="form-control" placeholder="Price"
                                                        name="price" required value="{{ $product->product_price }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Discount Price</label>
                                                    <input type="number" class="form-control"
                                                        placeholder="Discount Price" name="discount_price" required
                                                        value="{{ $product->discount_price }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Quantity</label>
                                                    <input type="number" class="form-control" placeholder="Quantity"
                                                        name="quantity" required
                                                        value="{{ $product->product_quantity }}">
                                                </div>
                                                <div class="inline-block relative w-64 " style="padding-bottom:1rem">
                                                    <label
                                                        style="font-size: 0.875rem;line-height: 1;
                                                        vertical-align: top;">Product
                                                        Category</label>
                                                    <select required name="category[]" class="aaa" multiple=""
                                                        style="height: 114px">
                                                        @foreach ($category as $category)
                                                            <option value="{{ $category->category_name }}"
                                                                >{{ $category->category_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                {{-- {{$product_category}} --}}

                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group text-align-center" style="margin:auto ">
                                                            <label for="exampleInputEmail1">Current Product
                                                                Image</label>
                                                            <br><br>
                                                            <img style="width: 7rem; height: 7rem;border-radius: 100%;margin: auto;display: block;"
                                                                src="/product/{{ $product->image }}">
                                                            <br>
                                                            <p class="text-center">{{ $product->image }} </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Product Image</label>
                                                            <div class="bbb">
                                                                <input type="file" id="file" class="inputfile"
                                                                    name="image" onchange='uploadFile(this)'>
                                                                <label for="file">
                                                                    <span class="file-box" id="file-name"></span>
                                                                    <span class="file-button">
                                                                        <i class="fa fa-upload" aria-hidden="true"></i>
                                                                        Select File
                                                                    </span>
                                                                </label>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group ccc">
                                                    <button type="submit" class="btn btn-primary me-2"
                                                        style="padding: 0.5rem">Submit</button>
                                                    {{-- <a href="{{ url('products', $product->id) }}"
                                                        class="btn btn-secondary me-2"
                                                        style="padding: 0.5rem;margin-left: 7.5rem;">Back</a> --}}
                                                    {{-- <a onclick="history.back()" class="btn btn-secondary me-2"
                                                        style="padding: 0.5rem;margin-left: 7.5rem;">Back</a> --}}
                                                </div>
                                            </div>
                                        </div>
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
    <script>
        function uploadFile(target) {
            document.getElementById("file-name").innerHTML = target.files[0].name;
        }
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>

    <base href="/public">
    @include('admin.css')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .card-title {
            color: #ffffff;
            margin-top: 0.5rem;
            text-transform: capitalize;
        }

        th {
            cursor: pointer;
        }
    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                        <div class="col-lg-10 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-row justify-content-between">
                                        <h4 class="card-title" style="">All Product</h4>
                                        <h4 class="card-title">total row : <span id="total_records"></span></h4>
                                        <div class="">
                                            <input class="form-control me-2" name="search" type="search"
                                                id="search" style="margin-right: 10rem" placeholder="Search"
                                                aria-label="Search">
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="myTable2">
                                            <thead>
                                                <tr>
                                                    <th onclick="sortTable(0)">Id <i class="fa fa-arrows-v"></i></th>
                                                    <th onclick="sortTable(1)">Name <i class="fa fa-arrows-v"></i></th>
                                                    <th onclick="sortTable(2)">Supplier <i class="fa fa-arrows-v"></i></th>
                                                    <th onclick="sortTable(3)">Category <i class="fa fa-arrows-v"></i></th>
                                                    <th onclick="sortTable(4)">Buy Price <i class="fa fa-arrows-v"></i></th>
                                                    <th onclick="sortTable(5)">Price <i class="fa fa-arrows-v"></i></th>
                                                    {{-- <th style="width: 10%">Discount Price</th> --}}
                                                    <th onclick="sortTable(6)">Quantity <i class="fa fa-arrows-v"></i></th>
                                                    <th style="cursor: default">Image</th>
                                                    <th style="cursor: default">View</th>
                                                    {{-- <th>Update</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                            {{-- <tbody>
                                                @foreach ($product as $product)
                                                    <tr>
                                                        <td>{{ $product->id }}</td>
                                                        <td>{{ $product->name }}</td>
                                                        <td>{{ $product->supplier }}</td>
                                                        <td>{{ $product->category }}</td>
                                                        <td>{{ $product->buy_price }}</td>
                                                        <td>{{ $product->product_price }}</td>
                                                        <td>{{ $product->product_quantity }}</td>
                                                        <td> <img src="/product/{{ $product->image }}"></td>
                                                        <td><a class="btn btn-primary me-2"
                                                                href="{{ url('all_product', $product->id) }}"
                                                                style="padding: 0.5rem">View</a>
                                                        </td>
                                                        <td><a class="btn btn-warning me-2"
                                                                href="{{ url('update_product', $product->id) }}"
                                                                style="padding: 0.5rem">Update</a>
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody> --}}
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

    <!-- jQuery -->
    {{-- <script src="//code.jquery.com/jquery.js"></script> --}}
    <!-- DataTables -->
    {{-- <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script> --}}
    <!-- Bootstrap JavaScript -->
    {{-- <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> --}}

    <script type="text/javascript">
        $(document).ready(function() {
            fetch_data();
        });
        $(document).on('keyup', '#search', function() {
            var query = $(this).val();
            fetch_data(query);
        });

        function fetch_data(query = '') {
            $.ajax({
                url: "{{ route('search') }}",
                method: 'GET',
                data: {
                    query: query
                },
                dataType: 'json',
                success: function(data) {
                    $('tbody').html(data.table_data);
                    $('#total_records').text(data.total_data);
                }
            })
        };

        function clickupArrow() {
            alert('up-arrow clicked');
        }

        function sortTable(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("myTable2");
            switching = true;
            dir = "asc";
            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    var cmpX = isNaN(parseInt(x.innerHTML)) ? x.innerHTML.toLowerCase() : parseInt(x.innerHTML);
                    var cmpY = isNaN(parseInt(y.innerHTML)) ? y.innerHTML.toLowerCase() : parseInt(y.innerHTML);
                    cmpX = (cmpX == '-') ? 0 : cmpX;
                    cmpY = (cmpY == '-') ? 0 : cmpY;
                    if (dir == "asc") {
                        if (cmpX > cmpY) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (cmpX < cmpY) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchcount++;
                } else {
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }
        /**
         * Sorts a HTML table.
         * 
         * @param {HTMLTableElement} table The table to sort
         * @param {number} column The index of the column to sort
         * @param {boolean} asc Determines if the sorting will be in ascending
         */
        // function sortTableByColumn(table, column, asc = true) {
        //     const dirModifier = asc ? 1 : -1;
        //     const tBody = table.tBodies[0];
        //     const rows = Array.from(tBody.querySelectorAll("tr"));

        //     // Sort each row
        //     const sortedRows = rows.sort((a, b) => {
        //         const aColText = a.querySelector(`td:nth-child(${ column + 1 })`).textContent.trim();
        //         const bColText = b.querySelector(`td:nth-child(${ column + 1 })`).textContent.trim();

        //         return aColText > bColText ? (1 * dirModifier) : (-1 * dirModifier);
        //     });

        //     // Remove all existing TRs from the table
        //     while (tBody.firstChild) {
        //         tBody.removeChild(tBody.firstChild);
        //     }

        //     // Re-add the newly sorted rows
        //     tBody.append(...sortedRows);

        //     // Remember how the column is currently sorted
        //     table.querySelectorAll("th").forEach(th => th.classList.remove("th-sort-asc", "th-sort-desc"));
        //     table.querySelector(`th:nth-child(${ column + 1})`).classList.toggle("th-sort-asc", asc);
        //     table.querySelector(`th:nth-child(${ column + 1})`).classList.toggle("th-sort-desc", !asc);
        // }
        // document.querySelectorAll(".table-sortable th").forEach(headerCell => {
        //     headerCell.addEventListener("click", () => {
        //         const tableElement = headerCell.parentElement.parentElement.parentElement;
        //         const headerIndex = Array.prototype.indexOf.call(headerCell.parentElement.children,
        //             headerCell);
        //         const currentIsAscending = headerCell.classList.contains("th-sort-asc");

        //         sortTableByColumn(tableElement, headerIndex, !currentIsAscending);
        //     });
        // });
    </script>

</body>

</html>

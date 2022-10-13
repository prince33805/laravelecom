<!DOCTYPE html>
<html>

<head>
    <base href="/public">
    @include('home.css')
    <style>
        td img {
            width: 3rem;
            height: 3rem;
            border-radius: 5rem;
        }

        h6 {
            font-weight: bold;
        }

        form input[type="submit"] {
            border: none;
            padding: 15px 35px;
            width: auto;
            font-size: 16px;
            text-transform: capitalize;
            line-height: normal;
            margin: 0 0.75rem;
            display: flex;
            background: green;
            color: #fff;
            font-weight: 600;
            transition: ease all 0.1s;
            border: 3px solid green;
            border-radius: 1%;

        }

        form input[type="submit"]:hover,
        form input[type="submit"]:focus {
            background: white;
            color: green;
            border: 3px solid green;
            border-radius: 1%;
        }

        .table1 {
            /* border: 1px solid red; */
            table-layout: fixed;
            white-space: normal;
            word-wrap: break-word;
        }

    </style>

</head>

<body>
    <div class="hero_area2">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
        <!-- slider section -->
        {{-- @include('home.slider') --}}
        <!-- end slider section -->
    </div>

    <section class="cart_section">
        <div class="container-fluid">
            <div class="heading_container heading_center" style="margin-bottom: 2rem;">
                <h2>Profile
                    {{-- <span>Detail</span> --}}
                </h2>
            </div>
            
            <div class="table">
                <table class="table table1">
                    <tbody>
                        <tr>
                            <th style="padding:2rem;" scope="row">User Id</th>
                            <td style="padding:2rem;">{{ $user->id }}</td>
                            <th style="padding:2rem;" scope="row">User Name</th>
                            <td style="padding:2rem;">{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th style="padding:2rem;" scope="row">Phone</th>
                            <td style="padding:2rem;">{{ $user->phone }}</td>
                            <th style="padding:2rem;" scope="row">Email</th>
                            <td style="padding:2rem;">{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th style="padding:2rem;" scope="row">Address</th>
                            <td style="padding:2rem;width:25%">{{ $user->address }}</td>
                            <th style="padding:2rem;" scope="row">Creted At</th>
                            <td style="padding:2rem;">{{ $user->created_at }}</td>
                        </tr>
                        <tr>
                            <th></th>
                            <td></td>
                            <th></th>
                            <td>
                                <a class="btn btn-warning me-2 " href="{{ url('update_profile') }}"
                                    style="padding: 0.5rem;">Update</a>      </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
            <br>
        </div>
    </section>

    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->

    @include('home.script')
</body>

</html>

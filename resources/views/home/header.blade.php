<header class="header_section">
    <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="{{ url('/') }}"><img width="250" src="images/logo.jpg"
                    alt="#" /></a>
            {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=""> </span>
            </button> --}}
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav" style="">

                    <li class="{{ request()->routeIs('index') ? 'nav-item active' : 'nav-item ' }} ">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="{{ request()->routeIs('products') ? 'nav-item active' : 'nav-item ' }} ">
                        <a class="nav-link" href="{{ route('products') }}">Products</a>
                    </li>

                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Pages <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="about.html">About</a></li>
                            <li><a href="testimonial.html">Testimonial</a></li>
                        </ul>
                    </li> --}}

                    {{-- <li class="nav-item">
                        <a class="nav-link" href="blog_list.html">Blog</a>
                    </li> --}}


                    @if (Route::has('login'))
                        @Auth
                            <li class="{{ request()->routeIs('cart') ? 'nav-item active' : 'nav-item ' }} ">
                                <a class="nav-link" href="{{ route('cart') }}">
                                    Cart[{{ $cartcount }}]
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link " href="#" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="true"><span class="nav-label "
                                        style=" 
                                max-width: 200px;
                                white-space: nowrap;
                                display: inline-block;
                                overflow: hidden;">
                                        {{ Auth::user()->name }}
                                    </span>
                                    {{-- padding-bottom: 10px --}}

                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        style="margin-top:-1rem" fill="currentColor" class="bi bi-caret-down-fill"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                                    </svg>


                                </a>

                                <ul class="dropdown-menu">
                                    {{-- <li><a href="{{ route('profile.show') }}">Profile</a></li> --}}
                                    <li><a href="{{ url('profile') }}">Profile</a></li>
                                    <li><a href="{{ url('orders') }}">Order</a></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                        this.closest('form').submit(); "
                                                role="button">
                                                {{ __('Log Out') }}
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @endauth
                    @endif

                    {{-- <form class="form-inline">
                        <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </form> --}}
                </ul>
            </div>
        </nav>
    </div>
</header>

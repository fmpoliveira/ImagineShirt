<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ImagineShirt</title>
    <link rel="icon" href="/img/plain_white.png" type="image/icon type">
    @vite('resources/sass/app.scss')
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-light">
        <!-- Navbar Brand-->
        <a class="navbar-brand " href="{{ route('home') }}">
            <img src="/img/logo.svg" alt="Logo" class="bg-light" width="140" height="52">
        </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-3 me-lg-0" id="sidebarToggle" href="#"><i
                class="fas fa-bars"></i></button>
        @guest
            <ul class="navbar-nav ms-auto me-1 me-lg-3">
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            {{ __('Login') }}
                        </a>
                    </li>
                @endif
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            {{ __('Register') }}
                        </a>
                    </li>
                @endif
            </ul>
        @else
            <div class="ms-auto me-0 me-md-2 my-2 my-md-0 navbar-text">
                {{ Auth::user()->name }}
            </div>
            <!-- Navbar-->
            <ul class="navbar-nav me-1 me-lg-3">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ Auth::user()->fullPhotoUrl }}" alt="Avatar" class="bg-light rounded-circle"
                            width="45" height="45">
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                        {{-- Admninistrator --}}
                        @if ((Auth::user()->user_type ?? '') == 'A')
                            <li><a class="dropdown-item"
                                    href="{{ route('users.show', ['user' => Auth::user()->id]) }}">Profile</a>
                            </li>
                        @endif

                        {{-- Customer --}}
                        @if ((Auth::user()->user_type ?? '') == 'C')
                            <li><a class="dropdown-item"
                                    href="{{ route('customers.show', ['customer' => Auth::user()->customer->id]) }}">Profile</a>
                            </li>
                        @endif

                        <li><a class="dropdown-item" href="{{ route('password.change.show') }}">Change Password</a></li>
                        <li>
                            <hr class="dropdown-divider" />
                        </li>
                        <li>
                            <a class="dropdown-item"
                                onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        @endguest
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark bg-light" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link {{ Route::currentRouteName() == 'tshirts.index' ? 'active' : '' }}"
                            href="{{ route('tshirts.index') }}">
                            <div style="width:20px" class="sb-nav-link-icon"><i class="fa-solid fa-bag-shopping"></i>
                            </div>
                            Shop
                        </a>

                        <a class="nav-link {{ Route::currentRouteName() == 'cart.show' ? 'active' : '' }}"
                            href="{{ route('cart.show') }}">
                            <div style="width:20px" class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                            Shopping Cart
                        </a>


                        {{-- Customer --}}
                        @can('viewPrivate', App\Models\Order::class)
                            <div style="color: rgba(224, 224, 224, 0.849)" class="sb-sidenav-menu-heading">Private Space</div>
                            <a class="nav-link {{ Route::currentRouteName() == 'privateOrder.indexPrivate' ? 'active' : '' }}"
                                href="{{ route('privateOrder.indexPrivate') }}">
                                <div style="width:20px" class="sb-nav-link-icon"><i class="fas fa-file-text"></i>
                                </div>
                                My Orders
                            </a>

                            <a class="nav-link {{ Route::currentRouteName() == 'privateTshirt.indexPrivate' ? 'active' : '' }}"
                                href="{{ route('privateTshirt.indexPrivate') }}">
                                <div style="width:20px" class="sb-nav-link-icon"><i class="fa-solid fa-shirt"></i></div>My
                                Tshirts
                            </a>
                        @endcan

                        {{-- Admin --}}
                        @can('viewAdminAndEmployee', App\Models\TshirtImage::class)
                            <div style="color: rgba(224, 224, 224, 0.849)" class="sb-sidenav-menu-heading">Admin</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#collapseAdminManager" aria-expanded="false"
                                aria-controls="collapseAdminManager">
                                <div style="width:20px" class="sb-nav-link-icon"><i class="fa-solid fa-user-secret"></i></div>
                                Management
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseAdminManager" aria-labelledby="headingTwo"
                                data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    @can('viewAdmin', App\Models\TshirtImage::class)
                                        <a class="nav-link {{ Route::currentRouteName() == 'tshirts.admin' ? 'active' : '' }}"
                                            href="{{ route('tshirts.admin') }}">
                                            Tshirt Manager
                                        </a>
                                        <a class="nav-link {{ Route::currentRouteName() == 'categories.index' ? 'active' : '' }}"
                                            href="{{ route('categories.index') }}">
                                            Category Manager
                                        </a>
                                        <a class="nav-link {{ Route::currentRouteName() == 'colors.index' ? 'active' : '' }}"
                                            href="{{ route('colors.index') }}">
                                            Color Manager
                                        </a>
                                        <a class="nav-link {{ Route::currentRouteName() == 'prices.index' ? 'active' : '' }}"
                                            href="{{ route('prices.index') }}">
                                            Price Manager
                                        </a>
                                        <a class="nav-link {{ Route::currentRouteName() == 'users.index' ? 'active' : '' }}"
                                            href="{{ route('users.index') }}">
                                            User Manager
                                        </a>
                                    @endcan
                                    <a class="nav-link {{ Route::currentRouteName() == 'orders.admin' ? 'active' : '' }}"
                                        href="{{ route('orders.admin') }}">
                                        Order Manager
                                    </a>
                                </nav>
                            </div>
                        @endcan




                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    @if (session('alert-msg'))
                        @include('shared.messages')
                    @endif
                    @if ($errors->any())
                        @include('shared.alertValidation')
                    @endif
                    <h1 class="mt-4">@yield('titulo', 'Politécnico de Leiria')</h1>
                    @yield('subtitulo')
                    <div class="mt-4">
                        @yield('main')
                    </div>
                </div>
            </main>
            <footer class="py-2 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy;Politécnico de Leiria 2023</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    @vite('resources/js/app.js')
</body>

</html>

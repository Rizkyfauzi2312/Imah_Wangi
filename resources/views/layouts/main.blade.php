
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Imah Wangi - Luxury Fragrance House')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts: Elegant Serif + Modern Sans Serif -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-valoria sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                IMAH WANGI
            </a>

            <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false"
                aria-label="Buka navigasi">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Beranda</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shop.index') }}">Koleksi</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('custom.index') }}">Parfum Custom</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart.index') }}">
                            <i class="fas fa-shopping-cart"></i> Keranjang
                            @if(session('cart') && count(session('cart')) > 0)
                                <span class="badge bg-danger">{{ count(session('cart')) }}</span>
                            @endif
                        </a>
                    </li>

                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Masuk</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Daftar</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#"
                                id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>

                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('orders.index') }}">
                                        Pesanan Saya
                                    </a>
                                </li>

                                @if(Auth::user()->isAdmin())
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            Panel Admin
                                        </a>
                                    </li>
                                @endif

                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Keluar
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}"
                                        method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-valoria">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>IMAH WANGI</h5>
                    <p>
                        Temukan aroma istimewamu.
                        Hadirkan karakter dan keunikan melalui koleksi
                        parfum eksklusif dari Imah Wangi.
                    </p>
                    <small>LUXURY FRAGRANCE HOUSE</small>
                </div>

                <div class="col-md-4 mb-4">
                    <h5>Navigasi</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('shop.index') }}">Koleksi Parfum</a></li>
                        <li><a href="{{ route('custom.index') }}">Parfum Custom</a></li>
                    </ul>
                </div>

                <div class="col-md-4 mb-4">
                    <h5>Hubungi Kami</h5>
                    <p>
                        <i class="fas fa-envelope"></i>
                        Email: Hubungi admin untuk informasi kontak resmi
                        <br>
                        <i class="fas fa-phone"></i>
                        Telepon: Hubungi admin untuk informasi kontak resmi
                    </p>
                </div>
            </div>

            <hr style="border-color: rgba(212, 175, 55, 0.3);">

            <div class="text-center">
                <p class="mb-0">
                    &copy; {{ date('Y') }} Imah Wangi.
                    Seluruh hak cipta dilindungi.
                </p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @stack('scripts')
</body>
</html>

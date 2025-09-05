<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $globalSettings->site_name ?? config('app.name', 'Laravel') }} - Admin</title>

    <!-- Favicon -->
    @if ($globalSettings->favicon ?? false)
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $globalSettings->favicon) }}">
    @else
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @endif

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #0d6efd;
            /* --primary: #dc3545; */
            --secondary: #6c757d;
            --success: #198754;
            --info: #0dcaf0;
            --warning: #ffc107;
            --danger: #dc3545;
            --light: #f8f9fa;
            --dark: #212529;
            --sidebar-bg: #212529;
            --sidebar-hover: rgba(255, 255, 255, 0.1);
            --sidebar-active: var(--danger);
            --card-border-radius: 0.5rem;
            --transition-speed: 0.3s;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fb;
        }

        /* Sidebar */
        .sidebar {
            background-color: var(--sidebar-bg);
            min-height: 100vh;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            transition: all var(--transition-speed);
        }

        .sidebar-brand {
            /* padding: 1.5rem 1rem; */
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.65);
            padding: 0.75rem 1.25rem;
            border-radius: 0.375rem;
            margin: 0.125rem 0.75rem;
            transition: all var(--transition-speed);
            font-weight: 500;
            font-size: 0.9rem;
        }

        .sidebar .nav-link:hover {
            color: rgba(255, 255, 255, 0.95);
            background-color: var(--sidebar-hover);
            transform: translateX(5px);
        }

        .sidebar .nav-link.active {
            color: #fff;
            background-color: var(--sidebar-active);
            box-shadow: 0 0.125rem 0.25rem rgba(13, 110, 253, 0.2);
        }

        .sidebar .nav-link i {
            width: 1.25rem;
            text-align: center;
        }

        /* Cards */
        .card {
            border-radius: var(--card-border-radius);
            transition: transform 0.2s, box-shadow 0.2s;
            overflow: hidden;
        }

        /* .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        } */

        .card-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-weight: 600;
        }

        .icon-circle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 3rem;
            height: 3rem;
        }

        .icon-square {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
        }

        /* Pagination */
        .page-item.active .page-link {
            background-color: var(--danger);
            border-color: var(--danger);
        }

        .page-link {
            color: var(--danger);
        }

        .page-link:hover {
            /* color: #0a58ca; */
            color: #dc5c68;
        }

        /* Buttons */
        .btn {
            font-weight: 500;
            border-radius: 0.375rem;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        /* Tables */
        .table {
            border-color: #f0f0f0;
        }

        .table thead th {
            background-color: rgba(0, 0, 0, 0.02);
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        /* Content wrapper */
        .content-wrapper {
            background-color: #fff;
            border-radius: var(--card-border-radius);
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .img-fluid {
            filter: invert(1);
            max-height: 62px;
            width: 112px;
        }

        .main-content {
            padding-left: 0px;
            padding-right: 0px;
        }
        
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">

            
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky">
                    <div class="sidebar-brand text-center">
                        @if ($globalSettings->logo ?? false)
                            <img src="{{ asset('storage/' . $globalSettings->logo) }}"
                                alt="{{ $globalSettings->site_name ?? 'Logo' }}" class="img-fluid">
                        @endif
                        {{-- <h4 class="text-white fw-bold mb-0">{{ $globalSettings->site_name ?? 'Admin Panel' }}</h4> --}}
                    </div>

                    <ul class="nav flex-column mt-4">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                                href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-gauge-high me-2"></i>
                                Dashboard
                            </a>
                        </li>

                        @role('super-admin')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                                    href="{{ route('admin.users.index') }}">
                                    <i class="fas fa-users-gear me-2"></i>
                                    Users
                                </a>
                            </li>
                        @endrole

                        <li class="nav-item mt-2">
                            <div class="text-uppercase text-white-50 px-3 py-2"
                                style="font-size: 0.75rem; font-weight: 600;">
                                <i class="fas fa-store me-2"></i> Catalog
                            </div>
                        </li>

                        @can('manage-products')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}"
                                    href="{{ route('admin.products.index') }}">
                                    <i class="fas fa-box me-2"></i>
                                    Products
                                </a>
                            </li>
                        @endcan

                        @can('manage-categories')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}"
                                    href="{{ route('admin.categories.index') }}">
                                    <i class="fas fa-tags me-2"></i>
                                    Categories
                                </a>
                            </li>
                        @endcan

                        @can('manage-brands')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.brands.*') ? 'active' : '' }}"
                                    href="{{ route('admin.brands.index') }}">
                                    <i class="fas fa-building me-2"></i>
                                    Brands
                                </a>
                            </li>
                        @endcan

                        <li class="nav-item mt-2">
                            <div class="text-uppercase text-white-50 px-3 py-2"
                                style="font-size: 0.75rem; font-weight: 600;">
                                <i class="fas fa-gear me-2"></i> System
                            </div>
                        </li>

                        @role('super-admin')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}"
                                    href="{{ route('admin.settings.index') }}">
                                    <i class="fas fa-sliders me-2"></i>
                                    Settings
                                </a>
                            </li>
                        @endrole
                        @role('super-admin')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.notifications.*') ? 'active' : '' }}"
                                    href="{{ route('admin.notifications.index') }}">
                                    <i class="fas fa-bell me-2"></i>
                                    Inquiries
                                </a>
                            </li>
                        @endrole

                        @role('super-admin')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.access-control.*') ? 'active' : '' }}"
                                    href="{{ route('admin.access-control.index') }}">
                                    <i class="fas fa-shield-halved me-2"></i>
                                    Access Control
                                </a>
                            </li>
                        @endrole
                    </ul>

                    <hr class="text-white-50 my-4">

                    <div class="px-3 py-2">
                        <div class="d-flex align-items-center text-white-50">
                            <div class="flex-shrink-0">
                                <i class="fas fa-circle-user fa-fw fa-lg me-2"></i>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <div class="small fw-semibold">{{ auth()->user()->name }}</div>
                                <div class="small opacity-75">{{ auth()->user()->roles->first()->name ?? 'User' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
                <!-- Top navbar -->
                <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
                    <div class="container-fluid mt-2">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target=".sidebar">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <!-- <h1 class="h4 mb-0 text-primary fw-bold d-none d-sm-block">@yield('title', 'Dashboard')</h1> -->

                        <div class="navbar-nav ms-auto">
                            <div class="position-relative me-3 d-none d-md-block">
                                <a href="{{ route('admin.notifications.index') }}"
                                    class="btn btn-light position-relative" data-bs-toggle="tooltip"
                                    title="Notifications">
                                    <i class="fas fa-bell"></i>
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $unreadCount }}
                                    </span>
                                </a>
                            </div>
                            <div class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                    role="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-user-circle me-2"></i>
                                    <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow">
                                    <li><a class="dropdown-item" href="{{ route('admin.profile.edit') }}">
                                            <i class="fas fa-user me-2"></i> Profile</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('admin.settings.index') }}">
                                            <i class="fas fa-cog me-2"></i> Settings</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Page content -->
                <div class="container-fluid">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show shadow-sm border-start border-success border-4"
                            role="alert">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-start border-danger border-4"
                            role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>

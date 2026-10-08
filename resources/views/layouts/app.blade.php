<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

        <style>
            body {
                font-family: 'Inter', sans-serif;
                background: #f4f7fb;
            }

            .topbar {
                background: linear-gradient(90deg, #0d6efd 0%, #1f4aa8 100%);
            }

            .sidebar {
                background: #ffffff;
                border-right: 1px solid #e5e7eb;
                min-height: calc(100vh - 72px);
            }

            .sidebar .nav-link {
                color: #374151;
                border-radius: 12px;
                padding: 0.8rem 1rem;
                font-weight: 500;
                transition: all 0.2s ease;
            }

            .sidebar .nav-link:hover,
            .sidebar .nav-link.active {
                background: #eef4ff;
                color: #0d6efd;
            }

            .icon-box {
                width: 52px;
                height: 52px;
                flex-shrink: 0;
            }

            @media (max-width: 991.98px) {
                .sidebar {
                    min-height: auto;
                    border-right: none;
                    border-bottom: 1px solid #e5e7eb;
                }
            }
        </style>
    </head>
    <body>
        <div class="min-vh-100">
            <nav class="topbar navbar navbar-expand-lg navbar-dark shadow-sm">
                <div class="container-fluid px-3 px-lg-4">
                    <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">Student Management System</a>

                    <div class="ms-auto d-flex align-items-center gap-3">
                        <button class="btn btn-link text-white p-0 position-relative" type="button" aria-label="Notifications">
                            <i class="bi bi-bell fs-5"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                        </button>

                        <div class="dropdown">
                            <button class="btn btn-link text-white dropdown-toggle d-flex align-items-center gap-2 p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-white text-primary fw-bold" style="width: 36px; height: 36px;">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                <span class="fw-medium">{{ Auth::user()->name }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i>Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('settings') }}"><i class="bi bi-gear me-2"></i>Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="container-fluid px-0">
                <div class="row g-0">
                    <aside class="sidebar col-lg-2 px-3 py-4">
                        <ul class="nav flex-column gap-2">
                            @php
                                $menuItems = [
                                    ['route' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'bi-grid-1x2'],
                                    ['route' => 'students.index','label' => 'Students', 'icon' => 'bi-people'],
                                    ['route' => 'courses.index', 'label' => 'Courses', 'icon' => 'bi-book'],
                                    ['route' => 'fees', 'label' => 'Fees', 'icon' => 'bi-currency-dollar'],
                                    ['route' => 'payments', 'label' => 'Payments', 'icon' => 'bi-credit-card'],
                                    ['route' => 'reports', 'label' => 'Reports', 'icon' => 'bi-bar-chart'],
                                    ['route' => 'profile.edit', 'label' => 'Profile', 'icon' => 'bi-person-circle'],
                                ];
                            @endphp

                            @foreach ($menuItems as $item)
                                <li>
                                    <a class="nav-link {{ request()->routeIs($item['route']) ? 'active' : '' }}" href="{{ route($item['route']) }}">
                                        <i class="bi {{ $item['icon'] }} me-2"></i>{{ $item['label'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </aside>

                    <main class="col-lg-10 px-3 px-lg-4 py-4">
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>

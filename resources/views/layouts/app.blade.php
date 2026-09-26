<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Student Management System') - Laravel Project Exam</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #4338ca 100%);
            --header-gradient: linear-gradient(135deg, #3730a3 0%, #4f46e5 50%, #6366f1 100%);
            --card-gradient: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%);
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --bg-light: #f1f5f9;
            --text-dark: #0f172a;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Navigation */
        .navbar-custom {
            background: #ffffff;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.07), 0 1px 2px -1px rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid #e2e8f0;
        }

        .navbar-custom .navbar-brand {
            font-weight: 700;
            color: #1e293b;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 1.15rem;
        }

        .navbar-custom .nav-link {
            font-weight: 500;
            color: #475569;
            padding: 0.5rem 0.9rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }

        .navbar-custom .nav-link:hover,
        .navbar-custom .nav-link.active {
            color: var(--primary-color);
            background-color: #eff6ff;
        }

        /* Main Container */
        .main-wrapper {
            flex: 1 0 auto;
            padding-top: 1.5rem;
            padding-bottom: 3rem;
        }

        /* Card Styling */
        .app-card {
            background: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
            border: 1px solid #e2e8f0;
            overflow: hidden;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        /* Gradient Banner Headers */
        .gradient-header {
            background: var(--header-gradient);
            color: #ffffff;
            padding: 2.25rem 2rem;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            position: relative;
        }

        .gradient-header h1,
        .gradient-header h2,
        .gradient-header h3 {
            font-weight: 700;
            letter-spacing: -0.02em;
            margin: 0;
        }

        .gradient-header p {
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.95rem;
            margin-top: 0.4rem;
            margin-bottom: 0;
        }

        /* Form Controls */
        .form-control, .form-select {
            border: 1.5px solid #e2e8f0;
            border-radius: 0.6rem;
            padding: 0.65rem 0.95rem;
            font-size: 0.95rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            background-color: #f8fafc;
        }

        .form-control:focus, .form-select:focus {
            background-color: #ffffff;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        .input-group-text {
            background-color: #f1f5f9;
            border: 1.5px solid #e2e8f0;
            color: #64748b;
            border-radius: 0.6rem;
        }

        /* Primary Button */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            font-weight: 600;
            border-radius: 0.6rem;
            padding: 0.65rem 1.4rem;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        }

        /* Secondary & Outline Buttons */
        .btn-outline-secondary {
            border-color: #cbd5e1;
            color: #475569;
            font-weight: 500;
            border-radius: 0.6rem;
            padding: 0.65rem 1.25rem;
        }

        .btn-outline-secondary:hover {
            background-color: #f1f5f9;
            color: #1e293b;
            border-color: #94a3b8;
        }

        .btn-teal {
            background-color: #06b6d4;
            border-color: #06b6d4;
            color: #ffffff;
            font-weight: 600;
            border-radius: 0.6rem;
            padding: 0.65rem 1.35rem;
        }

        .btn-teal:hover {
            background-color: #0891b2;
            border-color: #0891b2;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(6, 182, 212, 0.25);
        }

        /* Stat KPI Cards (Page 7) */
        .kpi-stat-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.25);
            border-radius: 0.75rem;
            padding: 1rem 1.5rem;
            text-align: center;
            color: #ffffff;
            min-width: 140px;
        }

        .kpi-stat-card .stat-number {
            font-size: 1.85rem;
            font-weight: 800;
            line-height: 1.1;
        }

        .kpi-stat-card .stat-label {
            font-size: 0.8rem;
            font-weight: 500;
            opacity: 0.9;
            margin-top: 0.2rem;
            text-transform: capitalize;
        }

        /* Table Styling */
        .table-custom {
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-custom th {
            background-color: #f8fafc;
            color: #475569;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.9rem 1.25rem;
            border-bottom: 1px solid #e2e8f0;
            border-top: none;
        }

        .table-custom td {
            padding: 1.1rem 1.25rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f5f9;
            color: #1e293b;
            font-size: 0.92rem;
        }

        .table-custom tbody tr:hover {
            background-color: #f8fafc;
        }

        /* Department Badge */
        .badge-dept {
            background-color: #eff6ff;
            color: #2563eb;
            font-size: 0.82rem;
            font-weight: 600;
            padding: 0.35rem 0.75rem;
            border-radius: 0.5rem;
            border: 1px solid #dbeafe;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        /* Action Buttons */
        .btn-action-icon {
            width: 32px;
            height: 32px;
            border-radius: 0.45rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            transition: all 0.15s ease;
            border: none;
            text-decoration: none;
        }

        .btn-action-view {
            background-color: #eff6ff;
            color: #3b82f6;
        }
        .btn-action-view:hover {
            background-color: #3b82f6;
            color: #ffffff;
        }

        .btn-action-edit {
            background-color: #ecfdf5;
            color: #10b981;
        }
        .btn-action-edit:hover {
            background-color: #10b981;
            color: #ffffff;
        }

        .btn-action-delete {
            background-color: #fef2f2;
            color: #ef4444;
        }
        .btn-action-delete:hover {
            background-color: #ef4444;
            color: #ffffff;
        }

        /* Footer */
        footer {
            background: #ffffff;
            border-top: 1px solid #e2e8f0;
            padding: 1.25rem 0;
            color: var(--text-muted);
            font-size: 0.875rem;
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Navigation Header -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('students.index') }}">
                <div style="width: 38px; height: 38px; border-radius: 0.6rem; background: var(--header-gradient); display: flex; align-items: center; justify-content: center; color: white;">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <span>SETEC Student MS</span>
            </a>

            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <i class="fa-solid fa-bars text-secondary"></i>
            </button>

            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('students.index') ? 'active' : '' }}" href="{{ route('students.index') }}">
                            <i class="fa-solid fa-users me-1 text-primary"></i> Student Directory
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('students.create') ? 'active' : '' }}" href="{{ route('students.create') }}">
                            <i class="fa-solid fa-user-plus me-1 text-primary"></i> Register Student
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('departments.*') ? 'active' : '' }}" href="{{ route('departments.index') }}">
                            <i class="fa-solid fa-building-columns me-1 text-primary"></i> Departments
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto align-items-center">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="dropdown">
                                <div style="width: 32px; height: 32px; border-radius: 50%; background: #e0e7ff; color: #4338ca; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.85rem;">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span class="fw-semibold text-dark">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                                <li class="px-3 py-2 border-bottom">
                                    <div class="small text-muted">Signed in as</div>
                                    <div class="fw-bold text-dark text-truncate" style="max-width: 200px;">{{ Auth::user()->email }}</div>
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger py-2 d-flex align-items-center gap-2">
                                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary btn-sm ms-2" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="main-wrapper">
        <div class="container">
            <!-- Flash Message Alerts -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center" role="alert">
                    <i class="fa-solid fa-circle-check fs-5 me-2 text-success"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center" role="alert">
                    <i class="fa-solid fa-circle-info fs-5 me-2 text-info"></i>
                    <div>{{ session('info') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center" role="alert">
                    <i class="fa-solid fa-triangle-exclamation fs-5 me-2 text-danger"></i>
                    <div>{{ session('error') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container text-center">
            <p class="mb-0">
                <strong>Student Management System</strong> &bull; Laravel Final Project Exam &bull; SETEC Institute
            </p>
        </div>
    </footer>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>

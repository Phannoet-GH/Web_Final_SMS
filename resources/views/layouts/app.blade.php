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
            --font-sans: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            --bg-body: #f8fafc;
            --bg-surface: #ffffff;
            --bg-muted: #f1f5f9;
            --border-color: #e2e8f0;
            --border-focus: #0f172a;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --text-subtle: #94a3b8;
            --primary: #0f172a;
            --primary-hover: #1e293b;
            --primary-fg: #ffffff;
            --accent: #2563eb;
            --accent-subtle: #eff6ff;
            --accent-border: #bfdbfe;
            --success: #10b981;
            --success-subtle: #f0fdf4;
            --danger: #ef4444;
            --danger-subtle: #fef2f2;
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --shadow-subtle: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-card: 0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px -1px rgba(0, 0, 0, 0.05);
            --shadow-popover: 0 10px 15px -3px rgba(0, 0, 0, 0.08), 0 4px 6px -4px rgba(0, 0, 0, 0.04);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-sans);
            background-color: var(--bg-body);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            letter-spacing: -0.011em;
            -webkit-font-smoothing: antialiased;
        }

        /* Minimalist Navigation Bar */
        .navbar-minimal {
            background-color: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border-color);
            padding: 0.75rem 0;
            z-index: 1020;
        }

        .navbar-brand-minimal {
            display: inline-flex;
            align-items: center;
            gap: 0.65rem;
            font-weight: 700;
            font-size: 1rem;
            color: var(--text-main);
            text-decoration: none;
            letter-spacing: -0.02em;
        }

        .navbar-brand-minimal:hover {
            color: var(--primary-hover);
        }

        .brand-icon-box {
            width: 32px;
            height: 32px;
            border-radius: var(--radius-md);
            background-color: var(--primary);
            color: var(--primary-fg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            box-shadow: var(--shadow-subtle);
        }

        .brand-badge {
            font-size: 0.68rem;
            font-weight: 600;
            padding: 0.15rem 0.45rem;
            border-radius: 9999px;
            background-color: var(--bg-muted);
            color: var(--text-muted);
            border: 1px solid var(--border-color);
            letter-spacing: 0.02em;
        }

        .nav-link-minimal {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-muted);
            padding: 0.4rem 0.75rem !important;
            border-radius: var(--radius-md);
            transition: all 0.15s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .nav-link-minimal:hover {
            color: var(--text-main);
            background-color: var(--bg-muted);
        }

        .nav-link-minimal.active {
            color: var(--text-main);
            background-color: var(--bg-muted);
            font-weight: 600;
        }

        /* User Pill & Dropdown */
        .user-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.35rem 0.65rem;
            border-radius: var(--radius-md);
            border: 1px solid var(--border-color);
            background-color: var(--bg-surface);
            color: var(--text-main);
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.15s ease;
            text-decoration: none;
        }

        .user-pill:hover, .user-pill:focus {
            background-color: var(--bg-muted);
            border-color: #cbd5e1;
            color: var(--text-main);
        }

        .user-avatar-sm {
            width: 24px;
            height: 24px;
            border-radius: var(--radius-sm);
            background-color: var(--primary);
            color: var(--primary-fg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.72rem;
            font-weight: 700;
        }

        .dropdown-menu-minimal {
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-popover);
            padding: 0.4rem;
            min-width: 210px;
            background-color: var(--bg-surface);
            animation: fadeIn 0.15s ease;
        }

        .dropdown-menu-minimal .dropdown-item {
            border-radius: var(--radius-sm);
            padding: 0.45rem 0.75rem;
            font-size: 0.85rem;
            color: var(--text-main);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.15s ease;
        }

        .dropdown-menu-minimal .dropdown-item:hover {
            background-color: var(--bg-muted);
            color: var(--text-main);
        }

        .dropdown-menu-minimal .dropdown-item.text-danger:hover {
            background-color: var(--danger-subtle);
            color: var(--danger) !important;
        }

        /* Main Wrapper */
        .main-wrapper {
            flex: 1 0 auto;
            padding-top: 2rem;
            padding-bottom: 3.5rem;
        }

        /* Modern Minimalist Card (Shadcn style) */
        .app-card {
            background-color: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-card);
            overflow: hidden;
            transition: border-color 0.2s ease;
        }

        /* Minimalist Card Header */
        .minimal-header {
            padding: 1.5rem 1.75rem;
            border-bottom: 1px solid var(--border-color);
            background-color: var(--bg-surface);
        }

        .minimal-header .header-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--accent);
            background-color: var(--accent-subtle);
            border: 1px solid var(--accent-border);
            padding: 0.2rem 0.6rem;
            border-radius: 9999px;
            margin-bottom: 0.5rem;
            letter-spacing: 0.02em;
        }

        .minimal-header h1,
        .minimal-header h2,
        .minimal-header h3 {
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--text-main);
            letter-spacing: -0.025em;
            margin: 0;
        }

        .minimal-header p {
            color: var(--text-muted);
            font-size: 0.875rem;
            margin-top: 0.25rem;
            margin-bottom: 0;
        }

        /* KPI Stat Cards (Minimalist SaaS metric cards) */
        .kpi-stat-card-minimal {
            background-color: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 1rem 1.25rem;
            box-shadow: var(--shadow-subtle);
            transition: all 0.2s ease;
            min-width: 140px;
        }

        .kpi-stat-card-minimal:hover {
            border-color: #cbd5e1;
            transform: translateY(-1px);
        }

        .kpi-stat-card-minimal .stat-label {
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--text-muted);
            margin-bottom: 0.35rem;
        }

        .kpi-stat-card-minimal .stat-number {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--text-main);
            line-height: 1.1;
            letter-spacing: -0.03em;
        }

        /* Form Controls (Shadcn-inspired inputs) */
        .form-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 0.35rem;
            letter-spacing: -0.01em;
        }

        .form-control, .form-select {
            background-color: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            padding: 0.55rem 0.85rem;
            font-size: 0.875rem;
            color: var(--text-main);
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }

        .form-control::placeholder {
            color: var(--text-subtle);
            font-size: 0.85rem;
        }

        .form-control:focus, .form-select:focus {
            background-color: var(--bg-surface);
            border-color: var(--border-focus);
            color: var(--text-main);
            box-shadow: 0 0 0 1px var(--border-focus);
            outline: none;
        }

        .input-group-text {
            background-color: var(--bg-muted);
            border: 1px solid var(--border-color);
            color: var(--text-muted);
            font-size: 0.85rem;
            border-radius: var(--radius-md);
        }

        .form-section-title {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-main);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            letter-spacing: -0.01em;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 1rem;
        }

        /* Buttons (Shadcn UI style: default dark, secondary outline, ghost) */
        .btn {
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: var(--radius-md);
            padding: 0.5rem 1rem;
            transition: all 0.15s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
            letter-spacing: -0.01em;
        }

        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            color: var(--primary-fg);
            box-shadow: var(--shadow-subtle);
        }

        .btn-primary:hover, .btn-primary:focus, .btn-primary:active {
            background-color: var(--primary-hover) !important;
            border-color: var(--primary-hover) !important;
            color: var(--primary-fg) !important;
            transform: translateY(-0.5px);
        }

        .btn-secondary, .btn-outline-secondary {
            background-color: var(--bg-surface);
            border: 1px solid var(--border-color);
            color: var(--text-main);
        }

        .btn-secondary:hover, .btn-outline-secondary:hover {
            background-color: var(--bg-muted);
            border-color: #cbd5e1;
            color: var(--text-main);
        }

        .btn-teal {
            background-color: #0f766e;
            border-color: #0f766e;
            color: #ffffff;
        }

        .btn-teal:hover {
            background-color: #115e59;
            border-color: #115e59;
            color: #ffffff;
        }

        /* Tables (Minimalist Clean Data Table) */
        .table-custom {
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
            width: 100%;
        }

        .table-custom th {
            background-color: var(--bg-muted);
            color: var(--text-muted);
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            padding: 0.75rem 1.25rem;
            border-bottom: 1px solid var(--border-color);
            border-top: none;
            white-space: nowrap;
        }

        .table-custom td {
            padding: 0.95rem 1.25rem;
            vertical-align: middle;
            border-bottom: 1px solid var(--border-color);
            color: var(--text-main);
            font-size: 0.875rem;
            background-color: var(--bg-surface);
        }

        .table-custom tbody tr:last-child td {
            border-bottom: none;
        }

        .table-custom tbody tr:hover td {
            background-color: #fcfdfe;
        }

        /* Student Initials Avatar */
        .student-avatar {
            width: 32px;
            height: 32px;
            border-radius: var(--radius-md);
            background-color: var(--bg-muted);
            border: 1px solid var(--border-color);
            color: var(--text-main);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.75rem;
            flex-shrink: 0;
        }

        /* Minimalist Badges (Shadcn style) */
        .badge-minimal {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.75rem;
            font-weight: 500;
            padding: 0.25rem 0.55rem;
            border-radius: var(--radius-sm);
            background-color: var(--bg-muted);
            color: var(--text-main);
            border: 1px solid var(--border-color);
        }

        .badge-dept {
            background-color: var(--accent-subtle);
            color: #1d4ed8;
            border: 1px solid var(--accent-border);
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.25rem 0.6rem;
            border-radius: var(--radius-sm);
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }

        /* Minimal Action Buttons */
        .btn-action-icon {
            width: 30px;
            height: 30px;
            border-radius: var(--radius-sm);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            transition: all 0.15s ease;
            border: 1px solid var(--border-color);
            background-color: var(--bg-surface);
            color: var(--text-muted);
            text-decoration: none;
        }

        .btn-action-icon:hover {
            color: var(--text-main);
            background-color: var(--bg-muted);
            border-color: #cbd5e1;
        }

        .btn-action-view:hover {
            color: var(--accent);
            border-color: var(--accent-border);
            background-color: var(--accent-subtle);
        }

        .btn-action-edit:hover {
            color: #059669;
            border-color: #a7f3d0;
            background-color: var(--success-subtle);
        }

        .btn-action-delete:hover {
            color: var(--danger);
            border-color: #fecaca;
            background-color: var(--danger-subtle);
        }

        /* Minimalist Alerts */
        .alert-minimal {
            background-color: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-left: 3px solid var(--primary);
            border-radius: var(--radius-md);
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            color: var(--text-main);
            box-shadow: var(--shadow-subtle);
        }

        .alert-minimal-success {
            border-left-color: var(--success);
        }

        .alert-minimal-danger {
            border-left-color: var(--danger);
        }

        .alert-minimal-info {
            border-left-color: var(--accent);
        }

        /* Minimalist Modals */
        .modal-content-minimal {
            background-color: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-popover);
            overflow: hidden;
        }

        .modal-header-minimal {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-header-minimal .modal-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 0;
            letter-spacing: -0.02em;
        }

        .modal-footer-minimal {
            padding: 1rem 1.5rem;
            border-top: 1px solid var(--border-color);
            background-color: var(--bg-muted);
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 0.5rem;
        }

        /* Minimalist Footer */
        footer {
            background-color: var(--bg-surface);
            border-top: 1px solid var(--border-color);
            padding: 1.25rem 0;
            color: var(--text-muted);
            font-size: 0.8125rem;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-4px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Minimalist Navigation Header -->
    <nav class="navbar navbar-expand-lg navbar-minimal sticky-top">
        <div class="container">
            <a class="navbar-brand-minimal" href="{{ route('students.index') }}">
                <div class="brand-icon-box">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <span>SETEC SMS</span>
                <span class="brand-badge ms-1">Laravel 13</span>
            </a>

            <button class="navbar-toggler border-0 p-1 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <i class="fa-solid fa-bars text-secondary"></i>
            </button>

            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3 gap-1">
                    <li class="nav-item">
                        <a class="nav-link-minimal {{ request()->routeIs('students.index') ? 'active' : '' }}" href="{{ route('students.index') }}">
                            <i class="fa-solid fa-users text-muted me-1"></i> Student Directory
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-minimal {{ request()->routeIs('students.create') ? 'active' : '' }}" href="{{ route('students.create') }}">
                            <i class="fa-solid fa-user-plus text-muted me-1"></i> Register Student
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-minimal {{ request()->routeIs('departments.*') ? 'active' : '' }}" href="{{ route('departments.index') }}">
                            <i class="fa-solid fa-building-columns text-muted me-1"></i> Departments
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto align-items-center">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="user-pill dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-avatar-sm">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-minimal dropdown-menu-end mt-2">
                                <li class="px-3 py-2 border-bottom">
                                    <div class="small text-muted" style="font-size: 0.75rem;">Signed in as</div>
                                    <div class="fw-semibold text-dark text-truncate" style="max-width: 190px; font-size: 0.85rem;">{{ Auth::user()->email }}</div>
                                </li>
                                <li class="pt-1">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Sign out
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link-minimal" href="{{ route('login') }}">Sign In</a>
                        </li>
                        <li class="nav-item ms-2">
                            <a class="btn btn-primary btn-sm px-3" href="{{ route('register') }}">Create Account</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="main-wrapper">
        <div class="container">
            <!-- Flash Message Alerts (Shadcn style clean borders) -->
            @if(session('success'))
                <div class="alert-minimal alert-minimal-success d-flex align-items-center justify-content-between mb-4" role="alert">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-circle-check text-success fs-6"></i>
                        <span class="fw-medium">{{ session('success') }}</span>
                    </div>
                    <button type="button" class="btn-close btn-sm shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('info'))
                <div class="alert-minimal alert-minimal-info d-flex align-items-center justify-content-between mb-4" role="alert">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-circle-info text-primary fs-6"></i>
                        <span class="fw-medium">{{ session('info') }}</span>
                    </div>
                    <button type="button" class="btn-close btn-sm shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert-minimal alert-minimal-danger d-flex align-items-center justify-content-between mb-4" role="alert">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-circle-exclamation text-danger fs-6"></i>
                        <span class="fw-medium">{{ session('error') }}</span>
                    </div>
                    <button type="button" class="btn-close btn-sm shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Minimalist Footer -->
    <footer>
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <div>
                <span class="fw-semibold text-dark">SETEC SMS</span>
                <span class="mx-1">&bull;</span>
                <span>Final Exam Web Project (Laravel 13)</span>
            </div>
            <div class="text-muted">
                Academic Management Portal &bull; Clean SaaS Template
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>

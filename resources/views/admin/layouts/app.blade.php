<!-- File: resources/views/admin/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') | Tole Kos</title>
    <link rel="icon" type="image/png" href="{{ asset('images/t.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            padding-top: 15px;
        }
        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.8rem 1rem;
            border-radius: 0;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }
        .sidebar .nav-link i {
            margin-right: 10px;
        }
        .content-wrapper {
            min-height: 100vh;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
        }
        .card {
            border: 0;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            margin-bottom: 20px;
        }
        .stat-card {
            border-left: 4px solid;
            border-radius: 4px;
        }
        .stat-card.primary {
            border-left-color: #4e73df;
        }
        .stat-card.success {
            border-left-color: #1cc88a;
        }
        .stat-card.warning {
            border-left-color: #f6c23e;
        }
        .stat-card .stat-icon {
            font-size: 32px;
            opacity: 0.3;
        }
        .dashboard-title {
            margin-bottom: 1.5rem;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 px-0 sidebar">
                <div class="d-flex justify-content-center align-items-center py-4">
                    <h4 class="text-white mb-0">Tole Kos</h4>
                </div>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.properties.index') ? 'active' : '' }}" href="{{ route('admin.properties.index') }}">
                            <i class="fas fa-home"></i> Properties
                        </a>
                    </li>
                    <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.profile.edit') }}">
        <i class="fas fa-user-cog"></i>
        <span>Edit Profile</span>
    </a>
</li>

                </ul>
                
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-10 px-0">
                <nav class="navbar navbar-expand navbar-light px-4 py-3">
                    <div class="container-fluid">
                        <h5 class="mb-0">@yield('page_title', 'Dashboard')</h5>
                        <div class="ms-auto">
                            <span class="me-2">Welcome, Admin</span>
                            <span class="text-muted">|</span>
                            <a href="#" class="ms-2 text-decoration-none text-danger" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </div>
                    </div>
                </nav>
                
                <div class="content-wrapper">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')

</body>
</html>




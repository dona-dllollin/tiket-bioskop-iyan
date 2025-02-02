<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bioskop App')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            @auth
            <div class="col-md-2 sidebar p-0">
                <div class="p-3">
                    <h4 class="text-white">Bioskop App</h4>
                </div>
                <nav>
                    @if(auth()->user()->role === 'manager')
                        <a href="{{ route('manager.dashboard') }}">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                        <a href="{{ route('movies.index') }}">
                            <i class="fas fa-film me-2"></i> Kelola Film
                        </a>
                        <a href="{{ route('schedules.index') }}">
                            <i class="fas fa-calendar-alt me-2"></i> Jadwal
                        </a>
                        <a href="{{ route('users.index') }}">
                            <i class="fas fa-users me-2"></i> Kelola User
                        </a>
                    @else
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                        <a href="{{ route('bookings.index') }}">
                            <i class="fas fa-ticket-alt me-2"></i> Pemesanan
                        </a>
                        <a href="{{ route('movies.search') }}">
                            <i class="fas fa-search me-2"></i> Cari Film
                        </a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn text-white w-100 text-start">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </nav>
            </div>
            @endauth

            <!-- Content -->
            <div class="col">
                <div class="content">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @stack('scripts')
</body>
</html> 
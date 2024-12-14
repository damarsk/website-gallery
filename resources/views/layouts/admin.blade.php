<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.1.0/mdb.min.css" rel="stylesheet" />
</head>

<body>
    <div class="d-flex flex-column flex-lg-row">
        <!-- Sidebar (Offcanvas untuk layar kecil dan Sidebar untuk layar besar) -->
        <div class="sidebar bg-dark text-white vh-100 d-none d-lg-flex flex-column sticky-top">
            <div class="p-3 flex-grow-1">
                <h4 class="mb-4 text-center">Album Glorious</h4>
                <hr>
                <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('admin.index') }}">
                    <i class="bi bi-house-door-fill"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('admin.users.index') }}">
                    <i class="bi bi-people-fill"></i> Manage Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('admin.photos.index') }}">
                    <i class="bi bi-images"></i> Manage Photos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-warning" href="{{ route('album.index') }}">
                    <i class="bi bi-box-arrow-left"></i> Back to Album
                    </a>

                </li>
                </ul>
            </div>
            <form method="POST" action="{{ route('signout') }}">
            @csrf
            <button type="submit" class="btn btn-danger w-100">
                <i class="bi bi-box-arrow-left"></i> Logout
            </button>
            </form>
        </div>

        <!-- Sidebar (Offcanvas untuk layar kecil) -->
        <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="offcanvasSidebar"
            aria-labelledby="offcanvasSidebarLabel" style="width: 250px;">
            <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasSidebarLabel">Album Glorious</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body p-0 d-flex flex-column">
            <ul class="nav flex-column flex-grow-1">
                <li class="nav-item">
                <a class="nav-link text-white py-3 px-3" href="{{ route('admin.index') }}">
                    <i class="bi bi-house-door-fill"></i> Dashboard
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link text-white py-3 px-3" href="{{ route('admin.users.index') }}">
                    <i class="bi bi-people-fill"></i> Manage Users
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link text-white py-3 px-3" href="{{ route('admin.photos.index') }}">
                    <i class="bi bi-images"></i> Manage Photos
                </a>
                </li>
            </ul>
            <form method="POST" action="{{ route('signout') }}">
                @csrf
                <button type="submit" class="btn btn-danger w-100">
                <i class="bi bi-box-arrow-left"></i> Logout
                </button>
            </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1 d-flex flex-column" style="min-height: 100vh;">
            <header class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
                <div class="container-fluid d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <!-- Tombol toggle sidebar (hanya muncul di layar kecil) -->
                        <button class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas" 
                            data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar" aria-label="Toggle Sidebar">
                            <i class="bi bi-list"></i>
                        </button>
                        <h1 class="h5 mb-0">@yield('header', 'Admin Dashboard')</h1>
                    </div>
                </div>
            </header>

            <main class="container my-4 flex-grow-1">
                @yield('content')
            </main>

            <footer class="bg-light text-center py-3 mt-auto">
                <small>&copy; 2024 Admin Panel. All rights reserved.</small>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @yield('scripts')
</body>

</html>

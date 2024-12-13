@extends('layouts.libraryonly')

@section('content')
    <div class="d-flex flex-column flex-lg-row">
        <nav class="sidebar bg-dark text-white vh-100 p-3 d-none d-lg-block">
            <h4 class="mb-4">Admin Panel</h4>
            <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('admin.index') }}">
                <i class="bi bi-house-door-fill"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="">
                <i class="bi bi-people-fill"></i> Manage Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="">
                <i class="bi bi-images"></i> Manage Photos
                </a>
            </li>
            <li class="nav-item mt-3">
                <form method="POST" action="{{ route('signout') }}">
                @csrf
                <button type="submit" class="btn btn-danger w-100">
                    <i class="bi bi-box-arrow-left"></i> Logout
                </button>
                </form>
            </li>
            </ul>
        </nav>

        <!-- Sidebar (Offcanvas untuk layar kecil) -->
        <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="offcanvasSidebar"
             aria-labelledby="offcanvasSidebarLabel" style="width: 250px;">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasSidebarLabel">Admin Panel</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body p-0">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white py-3 px-3" href="{{ route('admin.index') }}">
                            <i class="bi bi-house-door-fill"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-3 px-3" href="#">
                            <i class="bi bi-people-fill"></i> Manage Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white py-3 px-3" href="#">
                            <i class="bi bi-images"></i> Manage Photos
                        </a>
                    </li>
                    <li class="nav-item mt-3 px-3">
                        <form method="POST" action="{{ route('signout') }}">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100">
                                <i class="bi bi-box-arrow-left"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
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
@endsection
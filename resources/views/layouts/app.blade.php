<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glorious 24</title>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.1.0/mdb.min.css" rel="stylesheet" />
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand me-5" href="{{ route('album') }}">Glorious<b>24</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav me-auto">
                    <a class="nav-link active" aria-current="page" href="{{ route('album') }}">Album</a>
                    <a class="nav-link" href="#">Blog</a>
                    <a class="nav-link" href="#">About</a>
                    @if(auth()->check() && auth()->user()->level == 'admin')
                    <a class="nav-link" href="{{ route('admin.index') }}">Admin Dashboard</a>
                    @endif
                </div>
                <hr class="mb-4">
                @auth
                <a class="btn btn-outline-primary me-2 mb-2 mb-lg-0" href="{{ route('tambah.album') }}">+ Tambah Foto</a>
                <form class="d-flex" action="{{ route('signout') }}" method="POST">
                    @csrf
                    <button class="btn btn-outline-danger mb-3 mb-lg-0" type="submit">Sign out</button>
                </form>
                @else
                <div class="d-flex">
                    <a class="btn btn-outline-success" href="{{ route('signup') }}">Sign Up</a>
                </div>
                @endauth
            </div>
        </div>
    </nav>
    @yield('content')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @yield('script')
</body>

</html>
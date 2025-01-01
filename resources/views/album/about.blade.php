@extends('layouts.app')
@section('title', 'Glorious24 | About Us')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h1>About Us</h1>
            </div>
            <div class="card-body">
                <p>Welcome to the Gallery, a place where we cherish and preserve memories. Our mission is to provide a platform for you to store and share your precious moments with loved ones.</p>
                <p>At the Gallery, we believe that every memory is worth keeping. Whether it's a family vacation, a special event, or just a moment in time, we are here to help you keep those memories alive.</p>
                <p>Thank you for visiting our website. We hope you enjoy your time here and create many more memories to share.</p>
            </div>
        </div>

        <!-- Features Section -->
        <div class="card shadow-sm mt-4">
            <div class="card-header bg-success text-white">
                <h2>Our Features</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <h4><i class="fas fa-cloud-upload-alt"></i> Easy Upload</h4>
                        <p>Upload your photos quickly and easily</p>
                    </div>
                    <div class="col-md-4">
                        <h4><i class="fas fa-share-alt"></i> Share Albums</h4>
                        <p>Share your albums with friends and family</p>
                    </div>
                    <div class="col-md-4">
                        <h4><i class="fas fa-lock"></i> Secure Storage</h4>
                        <p>Your memories are safe with us</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="card shadow-sm mt-4 mb-5">
            <div class="card-header bg-info text-white">
                <h2>Contact Us</h2>
            </div>
            <div class="card-body">
                <p><i class="fas fa-envelope"></i> Email: contact@gallery.com</p>
                <p><i class="fas fa-phone"></i> Phone: (123) 456-7890</p>
                <p><i class="fas fa-map-marker-alt"></i> Address: 123 Gallery Street, Digital City</p>
            </div>
        </div>
    </div>

    <footer class="bg-body-tertiary py-5">
        <div class="container-fluid">
            <div class="container">
                <p class="float-end mb-1">
                    <a href="#">Kembali ke atas</a>
                </p>
                <p class="mb-1">&copy; 2024 (Glorious<b>24</b>) Album Kenangan. Semua hak cipta dilindungi undang-undang.
                </p>
                <p class="mb-0 text-body-secondary"><i>"Perpisahan bukan akhir kebersamaan, melainkan awal dari kenangan
                        yang akan selalu hidup di hati."</i></p>
            </div>
        </div>
    </footer>
@endsection
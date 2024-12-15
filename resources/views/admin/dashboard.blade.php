@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('content')
    <div class="container py-5">
        <h1 class="display-5">Admin Dashboard</h1>
        <p class="lead mb-4">Welcome to the admin dashboard. You can manage users and photos here.</p>
        <div class="row">
            <div class="col-md-6">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Manage Users</h5>
                        <p class="card-text">View, add, edit, and delete users.</p>
                        <p class="card-text"><strong>Total Users: </strong>{{ $totalUsers }}</p>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-light">Kelola Pengguna</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-primary text-white mt-2 mt-md-0 mt-lg-0">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Manage Photos</h5>
                        <p class="card-text">View, add, edit, and delete photos.</p>
                        <p class="card-text"><strong>Total Photos: </strong>{{ $totalPhotos }}</p>
                        <a href="{{ route('admin.photos.index') }}" class="btn btn-light">Kelola Foto</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

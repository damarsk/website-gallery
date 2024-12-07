@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-center align-items-center" style="height: 90vh;">
    <div class="w-50">
        <h2 class="text-center">Tambah Album</h2>
        <form action="{{ route('album') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Judul Foto</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group mt-4">
                <label for="description">Deskripsi:</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="form-group mt-4">
                <label for="photo_date">Tanggal Foto Diambil:</label>
                <input type="date" class="form-control" id="photo_date" name="photo_date" required>
            </div>
            <div class="form-group mt-4">
                <label for="cover_image">Gambar Sampul:</label>
                <input type="file" class="form-control-file" id="cover_image" name="cover_image" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-3">Tambah Album</button>
        </form>
    </div>
</div>
@endsection
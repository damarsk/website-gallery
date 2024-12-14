@extends('layouts.admin')
@section('title', 'Manage Photos')
@section('content')

<div class="container">
    <h2>Daftar Foto</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($photos as $index => $photo)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    <img src="{{ asset('storage/' . $photo->url) }}" alt="{{ $photo->title }}" width="100">
                </td>
                <td>{{ $photo->title }}</td>
                <td>{{ $photo->description }}</td>
                {{-- <td>
                    <a href="{{ route('photos.show', $photo->id) }}" class="btn btn-info">Lihat</a>
                    <a href="{{ route('photos.edit', $photo->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('photos.destroy', $photo->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus foto ini?')" class="btn btn-danger">Hapus</button>
                    </form>
                </td> --}}
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
@extends('layouts.admin')
@section('title', 'Manage Users')
@section('content')

<div class="container mt-5">
    <h2>Daftar Pengguna</h2>
    {{-- <a href="{{ route('users.create') }}" class="btn btn-success mb-3">Tambah Pengguna</a> --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td class="text-center">
                    <button href="{{ route('admin.users.show', $user->id) }}" class="btn btn-info" disabled>Lihat</button>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
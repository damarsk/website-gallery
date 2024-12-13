@extends('layouts.admin')
@section('title', 'Manage Users')
@section('content')

<div class="container mt-5">
    <h2>Daftar Pengguna</h2>
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
            <tr id="row-user-{{ $user->id }}">
                <td>{{ $index + 1 }}</td>
                <td class="user-name-{{ $user->id }}">{{ $user->name }}</td>
                <td class="user-email-{{ $user->id }}">{{ $user->email }}</td>
                <td class="text-center">
                    <button data-id="{{ $user->id }}" class="btn btn-info btn-show-user">Lihat</button>
                    <button data-id="{{ $user->id }}" class="btn btn-primary btn-edit-user">Edit</button>
                    <button data-id="{{ $user->id }}" class="btn btn-danger btn-delete-user">Hapus</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Lihat User -->
<div class="modal fade" id="modalShowUser" tabindex="-1" aria-labelledby="modalShowUserLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalShowUserLabel">Detail Pengguna</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Nama: </strong><span id="detailName"></span></p>
        <p><strong>Email: </strong><span id="detailEmail"></span></p>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit User -->
<div class="modal fade" id="modalEditUser" tabindex="-1" aria-labelledby="modalEditUserLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalEditUserLabel">Edit Pengguna</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formEditUser">
          @csrf
          <input type="hidden" name="user_id" id="editUserId">
          <div class="mb-3">
            <label for="editName" class="form-label">Nama</label>
            <input type="text" class="form-control" name="name" id="editName" required>
          </div>
          <div class="mb-3">
            <label for="editEmail" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="editEmail" required>
          </div>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
// Mengambil token CSRF dari meta tag (pastikan Anda menaruh <meta name="csrf-token" content="{{ csrf_token() }}"> di layout)
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Event klik tombol Lihat
$('.btn-show-user').on('click', function() {
    var userId = $(this).data('id');
    $.ajax({
        url: "{{ url('admin/users') }}/" + userId,
        type: 'GET',
        dataType: 'json',
        success: function(res) {
            $('#detailName').text(res.name);
            $('#detailEmail').text(res.email);
            $('#modalShowUser').modal('show');
        },
        error: function(err) {
            alert('Gagal memuat data pengguna!');
        }
    });
});

// Event klik tombol Edit
$('.btn-edit-user').on('click', function() {
    var userId = $(this).data('id');
    $.ajax({
        url: "{{ url('admin/users') }}/" + userId + "/edit",
        type: 'GET',
        dataType: 'json',
        success: function(res) {
            $('#editUserId').val(res.id);
            $('#editName').val(res.name);
            $('#editEmail').val(res.email);
            $('#modalEditUser').modal('show');
        },
        error: function(err) {
            alert('Gagal memuat data pengguna!');
        }
    });
});

// Submit form Edit
$('#formEditUser').on('submit', function(e) {
    e.preventDefault();
    var userId = $('#editUserId').val();
    var formData = $(this).serialize();

    $.ajax({
        url: "{{ url('admin/users') }}/" + userId,
        type: 'PUT',
        data: formData,
        success: function(res) {
            $('.user-name-' + userId).text(res.name);
            $('.user-email-' + userId).text(res.email);
            $('#modalEditUser').modal('hide');
        },
        error: function(err) {
            alert('Gagal memperbarui data!');
        }
    });
});

// Event klik tombol Hapus
$('.btn-delete-user').on('click', function() {
    if(!confirm('Apakah Anda yakin ingin menghapus pengguna ini?')) {
        return;
    }
    var userId = $(this).data('id');
    $.ajax({
        url: "{{ url('admin/users') }}/" + userId,
        type: 'DELETE',
        success: function(res) {
            // Hapus baris tabel
            $('#row-user-' + userId).remove();
        },
        error: function(err) {
            alert('Gagal menghapus data!');
        }
    });
});
</script>
@endpush
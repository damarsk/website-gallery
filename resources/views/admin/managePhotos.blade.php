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
            <tr id="row-photo-{{ $photo->id }}">
                <td>{{ $index + 1 }}</td>
                <td>
                    <img src="{{ asset('storage/' . $photo->url) }}" alt="{{ $photo->title }}" width="100">
                </td>
                <td>{{ $photo->title }}</td>
                <td>{{ $photo->description }}</td>
                <td>
                    <center>
                        <button data-id="{{ $photo->id }}" class="btn btn-danger btn-delete-photo">Hapus</button>
                    </center>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="modalConfirmDelete" tabindex="-1" aria-labelledby="modalConfirmDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalConfirmDeleteLabel">Konfirmasi Hapus</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus foto ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Hapus</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    // Event klik tombol Hapus
    let photoIdToDelete;
    $(document).on('click', '.btn-delete-photo', function () {
        photoIdToDelete = $(this).data('id');
        $('#modalConfirmDelete').modal('show');
    });

    // Konfirmasi penghapusan
    $('#confirmDeleteButton').on('click', function () {
        if (!photoIdToDelete) return;

        $.ajax({
            url: "{{ url('admin/photos') }}/" + photoIdToDelete + "/delete",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                _method: 'DELETE'
            },
            success: function (res) {
                $('#row-photo-' + photoIdToDelete).remove();
                $('#modalConfirmDelete').modal('hide');
            },
            error: function (err) {
                alert('Gagal menghapus data!');
            }
        });
    });
</script>

@endsection
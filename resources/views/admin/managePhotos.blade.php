@extends('layouts.admin')
@section('title', 'Manage Photos')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
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

    <!-- Modal Box -->
    <div class="modal fade" id="photoModal" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="photoModalLabel">Detail Foto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="modal-content"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Lihat Foto
            $('.btn-view').click(function() {
                const id = $(this).data('id');
                $.get(`photos/${id}`, function(data) {
                    const content = `
                <div class="text-center">
                <img src="{{ asset('storage/') }}/${data.url}" alt="${data.title}" class="img-fluid mb-3" style="max-height: 300px;">
                </div>
                <p><strong>Judul:</strong> ${data.title}</p>
                <p><strong>Deskripsi:</strong> ${data.description || 'Tidak ada deskripsi.'}</p>
                <p><strong>Tanggal Foto:</strong> ${data.photo_date || 'Tidak diketahui.'}</p>
            `;
                    $('#modal-content').html(content);
                    $('#photoModalLabel').text('Lihat Foto');
                    $('#photoModal').modal('show');
                });
            });

            // Edit Foto
            // Load Edit Photo Form
            $(document).on('click', '.btn-edit', function() {
                const id = $(this).data('id');
                $.get(`photos/${id}`, function(data) {
                    const form = `
            <form id="edit-photo-form">
                <input type="hidden" id="edit-photo-id" name="id" value="${data.id}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="mb-3">
                    <label for="title" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="title" name="title" value="${data.title}" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" rows="3">${data.description}</textarea>
                </div>
                <div class="mb-3">
                    <label for="photo_date" class="form-label">Tanggal Foto</label>
                    <input type="date" class="form-control" id="photo_date" name="photo_date" value="${data.photo_date}">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
            `;
                    $('#modal-content').html(form);
                    $('#photoModalLabel').text('Edit Foto');
                    $('#photoModal').modal('show');
                });
            });
            // Form Edit Foto
            $(document).on('submit', '#edit-photo-form', function(e) {
                e.preventDefault();
                const id = $('#edit-photo-id').val();
                const formData = new FormData(this);

                $.ajax({
                    url: `photos/${id}/edit`, // Sesuaikan jika ada prefix route
                    type: 'PATCH',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#photoModal').modal('hide');

                        // Update baris tabel
                        const row = $(`button[data-id="${response.photo.id}"]`).closest('tr');
                        row.find('td:nth-child(3)').text(response.photo.title); // Update judul
                        row.find('img').attr('src',
                            `{{ asset('storage/') }}/${response.photo.url}`); // Update gambar
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Gagal mengedit foto. Cek konsol untuk detail.');
                    }
                });
            });


            // Hapus Foto
            $('.btn-delete').click(function() {
                const id = $(this).data('id');
                if (confirm('Apakah Anda yakin ingin menghapus foto ini?')) {
                    $.ajax({
                        url: `photos/${id}`,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function() {
                            location.reload();
                        },
                        error: function() {
                            alert('Gagal menghapus foto.');
                        }
                    });
                }
            });
        });
    </script>
@endsection

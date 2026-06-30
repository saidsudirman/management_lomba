{{-- resources/views/admin/gallery/show.blade.php --}}
@extends('layout.app')

@section('title', 'Detail Album - ' . $album->nama_album)

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h4 class="card-title">Detail Album</h4>
                                <h5 class="text-muted">{{ $album->nama_album }}</h5>
                            </div>
                            <div>
                                <a href="{{ route('gallery.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <a href="{{ route('gallery.edit', $album->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit"></i> Edit Album
                                </a>
                            </div>
                        </div>

                        <!-- Info Album -->
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <img src="{{ asset($album->cover_image ?? 'img/default-album.jpg') }}" 
                                     alt="{{ $album->nama_album }}" 
                                     style="width: 100%; max-height: 200px; object-fit: cover; border-radius: 5px;">
                            </div>
                            <div class="col-md-9">
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="width: 150px;">Nama Album</th>
                                        <td>{{ $album->nama_album }}</td>
                                    </tr>
                                    <tr>
                                        <th>Deskripsi</th>
                                        <td>{{ $album->deskripsi ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Lokasi</th>
                                        <td>{{ $album->lokasi ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal</th>
                                        <td>{{ $album->tanggal ? \Carbon\Carbon::parse($album->tanggal)->format('d F Y') : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Foto</th>
                                        <td><span class="badge badge-info">{{ $album->photos->count() }}</span></td>
                                    </tr>
                                    <tr>
                                        <th>Dibuat</th>
                                        <td>{{ $album->created_at->format('d F Y H:i') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- Form Tambah Foto -->
                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Tambah Foto</h5>
                                <form action="{{ route('gallery.photo.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="album_id" value="{{ $album->id }}">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Foto <span class="text-danger">*</span></label>
                                                <input type="file" name="foto" class="form-control" accept="image/*" required>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>&nbsp;</label>
                                                <button type="submit" class="btn btn-primary btn-block">Tambah</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Daftar Foto -->
                        <h5 class="mb-3">Daftar Foto ({{ $album->photos->count() }})</h5>
                        @if($album->photos->count() > 0)
                            <div class="row">
                                @foreach($album->photos as $photo)
                                    <div class="col-md-3 col-sm-4 col-6 mb-3">
                                        <div class="card h-100">
                                            <img src="{{ asset($photo->foto) }}" 
                                                 alt="{{ $photo->judul }}" 
                                                 style="width: 100%; height: 200px; object-fit: cover;">
                                            <div class="card-body p-2">
                                                <h6 class="card-title mb-0">{{ $photo->judul ?? 'Foto ' . $loop->iteration }}</h6>
                                                @if($photo->deskripsi)
                                                    <small class="text-muted">{{ Str::limit($photo->deskripsi, 30) }}</small>
                                                @endif
                                                <div class="mt-2">
                                                    <button type="button" class="btn btn-warning btn-sm" 
                                                            data-toggle="modal" 
                                                            data-target="#editPhotoModal{{ $photo->id }}">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm" 
                                                            onclick="confirmDeletePhoto('{{ $photo->id }}')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Edit Foto -->
                                    <div class="modal fade" id="editPhotoModal{{ $photo->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Foto</h5>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <form action="{{ route('gallery.photo.update', $photo->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Foto Saat Ini</label>
                                                            <img src="{{ asset($photo->foto) }}" 
                                                                 alt="Foto" 
                                                                 style="width: 100%; max-height: 200px; object-fit: cover; border-radius: 5px;">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Ganti Foto</label>
                                                            <input type="file" name="foto" class="form-control" accept="image/*">
                                                            <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Judul</label>
                                                            <input type="text" name="judul" class="form-control" 
                                                                   value="{{ $photo->judul }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Deskripsi</label>
                                                            <input type="text" name="deskripsi" class="form-control" 
                                                                   value="{{ $photo->deskripsi }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Urutan</label>
                                                            <input type="number" name="urutan" class="form-control" 
                                                                   value="{{ $photo->urutan }}" min="0">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-images fa-2x text-muted mb-2"></i>
                                <p class="mb-0">Belum ada foto dalam album ini</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Delete Photo Confirmation
    function confirmDeletePhoto(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Foto akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("gallery.photo.destroy", "") }}/' + id;
                form.innerHTML = '@csrf @method("DELETE")';
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    // Notification
    @if (session('notification'))
        $(document).ready(function() {
            const notif = @json(session('notification'));
            Swal.fire({
                icon: notif.type,
                title: notif.title,
                text: notif.text,
                timer: 3000,
                timerProgressBar: true
            });
        });
    @endif
</script>
@endpush
@endsection
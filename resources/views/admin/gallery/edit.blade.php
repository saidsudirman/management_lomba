{{-- resources/views/admin/gallery/edit.blade.php --}}
@extends('layout.app')

@section('title', 'Edit Album Galeri')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="card-title">Edit Album Galeri</h4>
                            <a href="{{ route('gallery.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>

                        <form action="{{ route('gallery.update', $album->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Nama Album <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_album" class="form-control @error('nama_album') is-invalid @enderror" 
                                               value="{{ old('nama_album', $album->nama_album) }}" required>
                                        @error('nama_album')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" 
                                                  rows="4">{{ old('deskripsi', $album->deskripsi) }}</textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Lokasi</label>
                                                <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror" 
                                                       value="{{ old('lokasi', $album->lokasi) }}">
                                                @error('lokasi')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal</label>
                                                <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" 
                                                       value="{{ old('tanggal', $album->tanggal) }}">
                                                @error('tanggal')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Cover Album</label>
                                        @if($album->cover_image)
                                            <div class="mb-2 text-center">
                                                <img src="{{ asset($album->cover_image) }}" alt="Cover" 
                                                     style="max-width: 100%; max-height: 200px; border-radius: 5px;">
                                            </div>
                                        @endif
                                        <div class="custom-file">
                                            <input type="file" name="cover_image" class="custom-file-input @error('cover_image') is-invalid @enderror" 
                                                   id="coverImage" accept="image/*">
                                            <label class="custom-file-label" for="coverImage">
                                                {{ $album->cover_image ? 'Ganti gambar' : 'Pilih gambar' }}
                                            </label>
                                        </div>
                                        @error('cover_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="mt-3 text-center">
                                            <img id="coverPreview" src="#" alt="Preview" 
                                                 style="display: none; max-width: 100%; max-height: 200px; border-radius: 5px;">
                                        </div>
                                        <small class="text-muted">Kosongkan jika tidak ingin mengubah cover</small>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right">
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Preview Cover Image
    document.getElementById('coverImage').addEventListener('change', function(e) {
        const preview = document.getElementById('coverPreview');
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
        }
    });

    // Update file input label
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = e.target.files[0] ? e.target.files[0].name : '{{ $album->cover_image ? "Ganti gambar" : "Pilih gambar" }}';
        var label = e.target.nextElementSibling;
        label.innerHTML = fileName;
    });
</script>
@endpush
@endsection
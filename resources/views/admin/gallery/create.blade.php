{{-- resources/views/admin/gallery/create.blade.php --}}
@extends('layout.app')

@section('title', 'Tambah Album Galeri')

@section('page-title', 'Tambah Album Galeri')

@section('breadcrumb')
    <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
    <div class="breadcrumb-item"><a href="{{ route('gallery.index') }}">Galeri</a></div>
    <div class="breadcrumb-item">Tambah Album</div>
@endsection

@push('styles')
<style>
    /* Card Styles */
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        background: #ffffff;
    }
    
    .card-body {
        padding: 30px;
    }
    
    .card-title {
        font-size: 22px;
        font-weight: 700;
        color: #2c3e50;
        margin: 0;
    }
    
    /* Form Styles */
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
        font-size: 14px;
    }
    
    .form-group label .text-danger {
        color: #e74c3c;
        margin-left: 2px;
    }
    
    .form-control {
        border-radius: 8px;
        border: 2px solid #e9ecef;
        padding: 10px 15px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: #fafbfc;
    }
    
    .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.15);
        background: #ffffff;
    }
    
    .form-control.is-invalid {
        border-color: #e74c3c;
    }
    
    .form-control.is-invalid:focus {
        box-shadow: 0 0 0 0.2rem rgba(231, 76, 60, 0.15);
    }
    
    .invalid-feedback {
        color: #e74c3c;
        font-size: 13px;
        margin-top: 5px;
    }
    
    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }
    
    /* Custom File Input */
    .custom-file {
        position: relative;
        display: inline-block;
        width: 100%;
        height: calc(1.5em + 0.75rem + 2px);
        margin-bottom: 0;
    }
    
    .custom-file-input {
        position: relative;
        z-index: 2;
        width: 100%;
        height: calc(1.5em + 0.75rem + 2px);
        margin: 0;
        opacity: 0;
        cursor: pointer;
    }
    
    .custom-file-label {
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        z-index: 1;
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fafbfc;
        border: 2px solid #e9ecef;
        border-radius: 8px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        transition: all 0.3s ease;
    }
    
    .custom-file-label::after {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        z-index: 3;
        display: block;
        padding: 0.375rem 0.75rem;
        line-height: 1.5;
        color: #495057;
        content: "Browse";
        background-color: #e9ecef;
        border-left: inherit;
        border-radius: 0 8px 8px 0;
        font-weight: 600;
    }
    
    .custom-file-input:focus ~ .custom-file-label {
        border-color: #3498db;
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.15);
    }
    
    .custom-file-input.is-invalid ~ .custom-file-label {
        border-color: #e74c3c;
    }
    
    /* Buttons */
    .btn {
        border-radius: 8px;
        font-weight: 600;
        padding: 10px 25px;
        font-size: 14px;
        transition: all 0.3s ease;
        border: none;
    }
    
    .btn-secondary {
        background: #e9ecef;
        color: #2c3e50;
    }
    
    .btn-secondary:hover {
        background: #dde1e6;
        color: #1a1a2e;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #3498db, #2980b9);
        color: #ffffff;
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, #2980b9, #1a6da0);
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
    }
    
    .btn i {
        margin-right: 8px;
    }
    
    /* Preview Image */
    #coverPreview {
        border: 2px solid #e9ecef;
        border-radius: 8px;
        padding: 5px;
        background: #fafbfc;
        max-width: 100%;
        max-height: 200px;
        object-fit: contain;
    }
    
    /* Alert */
    .alert {
        border-radius: 10px;
        border: none;
        padding: 15px 20px;
    }
    
    .alert-danger {
        background: #fde8e8;
        color: #c0392b;
    }
    
    .alert-danger ul {
        padding-left: 20px;
        margin: 0;
    }
    
    .alert .close {
        color: #c0392b;
        opacity: 0.7;
    }
    
    .alert .close:hover {
        opacity: 1;
    }
    
    /* Text Muted */
    .text-muted {
        color: #6c757d !important;
        font-size: 12px;
        display: block;
        margin-top: 8px;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .card-body {
            padding: 20px;
        }
        
        .card-title {
            font-size: 18px;
        }
        
        .btn {
            padding: 8px 18px;
            font-size: 13px;
            width: 100%;
            margin-top: 5px;
        }
        
        .text-right {
            text-align: center !important;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
    }
    
    @media (max-width: 576px) {
        .card-body {
            padding: 15px;
        }
        
        .card-title {
            font-size: 16px;
        }
        
        .form-control {
            font-size: 13px;
            padding: 8px 12px;
        }
    }
</style>
@endpush

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="card-title">
                                <i class="fas fa-plus-circle" style="color: #3498db; margin-right: 10px;"></i>
                                Tambah Album Galeri
                            </h4>
                            <a href="{{ route('gallery.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle" style="margin-right: 10px;"></i>
                                <strong>Perhatikan!</strong> Ada beberapa kesalahan:
                                <ul class="mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Nama Album <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_album" 
                                               class="form-control @error('nama_album') is-invalid @enderror" 
                                               value="{{ old('nama_album') }}" 
                                               required 
                                               placeholder="Masukkan nama album">
                                        @error('nama_album')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <textarea name="deskripsi" 
                                                  class="form-control @error('deskripsi') is-invalid @enderror" 
                                                  rows="4" 
                                                  placeholder="Masukkan deskripsi album">{{ old('deskripsi') }}</textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Lokasi</label>
                                                <input type="text" name="lokasi" 
                                                       class="form-control @error('lokasi') is-invalid @enderror" 
                                                       value="{{ old('lokasi') }}" 
                                                       placeholder="Masukkan lokasi">
                                                @error('lokasi')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal</label>
                                                <input type="date" name="tanggal" 
                                                       class="form-control @error('tanggal') is-invalid @enderror" 
                                                       value="{{ old('tanggal') }}">
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
                                        <div class="custom-file">
                                            <input type="file" name="cover_image" 
                                                   class="custom-file-input @error('cover_image') is-invalid @enderror" 
                                                   id="coverImage" 
                                                   accept="image/*">
                                            <label class="custom-file-label" for="coverImage">
                                                <i class="fas fa-cloud-upload-alt" style="margin-right: 8px;"></i>
                                                Pilih gambar
                                            </label>
                                        </div>
                                        @error('cover_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="mt-3 text-center">
                                            <img id="coverPreview" src="#" alt="Preview" 
                                                 style="display: none; max-width: 100%; max-height: 200px; border-radius: 8px; border: 2px dashed #ddd; padding: 10px;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-right mt-3">
                                <button type="reset" class="btn btn-secondary">
                                    <i class="fas fa-undo"></i> Reset
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
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
                preview.style.border = '2px solid #3498db';
            }
            reader.readAsDataURL(file);
        } else {
            preview.style.display = 'none';
            preview.style.border = '2px dashed #ddd';
        }
    });

    // Update file input label
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
        var fileName = e.target.files[0] ? e.target.files[0].name : 'Pilih gambar';
        var label = e.target.nextElementSibling;
        label.innerHTML = '<i class="fas fa-cloud-upload-alt" style="margin-right: 8px;"></i> ' + fileName;
    });

    // Auto dismiss alert
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
</script>
@endpush
@endsection
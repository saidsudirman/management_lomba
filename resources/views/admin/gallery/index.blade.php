{{-- resources/views/admin/gallery/index.blade.php --}}
@extends('layout.app')

@section('title', 'Galeri')

@section('page-title', 'Data Album Galeri')

@section('breadcrumb')
    <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
    <div class="breadcrumb-item">Galeri</div>
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
        padding: 25px;
    }
    
    .card-title {
        font-size: 20px;
        font-weight: 700;
        color: #2c3e50;
        margin: 0;
    }
    
    /* Table Styles */
    .table {
        margin-bottom: 0;
        font-size: 14px;
    }
    
    .table thead th {
        background: #f8f9fa;
        color: #2c3e50;
        font-weight: 600;
        border-bottom: 2px solid #e9ecef;
        padding: 12px 15px;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .table tbody td {
        padding: 12px 15px;
        vertical-align: middle;
        border-bottom: 1px solid #e9ecef;
    }
    
    .table tbody tr:hover {
        background: #f8f9fa;
    }
    
    .table tbody tr:last-child td {
        border-bottom: none;
    }
    
    /* Cover Image */
    .cover-thumb {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }
    
    .cover-thumb:hover {
        transform: scale(1.1);
        border-color: #3498db;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    }
    
    .cover-placeholder {
        width: 50px;
        height: 50px;
        background: #f1f3f5;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #adb5bd;
        font-size: 20px;
        border: 2px dashed #dee2e6;
    }
    
    /* Badge */
    .badge-photo {
        background: #3498db;
        color: #fff;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .badge-photo i {
        margin-right: 5px;
    }
    
    /* Buttons */
    .btn-group .btn {
        margin: 0 2px;
        padding: 5px 10px;
        font-size: 12px;
        border-radius: 6px;
        transition: all 0.3s ease;
    }
    
    .btn-group .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
    
    .btn-info {
        background: #17a2b8;
        border-color: #17a2b8;
        color: #fff;
    }
    
    .btn-info:hover {
        background: #138496;
        border-color: #138496;
        color: #fff;
    }
    
    .btn-warning {
        background: #f39c12;
        border-color: #f39c12;
        color: #fff;
    }
    
    .btn-warning:hover {
        background: #d68910;
        border-color: #d68910;
        color: #fff;
    }
    
    .btn-danger {
        background: #e74c3c;
        border-color: #e74c3c;
        color: #fff;
    }
    
    .btn-danger:hover {
        background: #c0392b;
        border-color: #c0392b;
        color: #fff;
    }
    
    .btn-primary {
        background: #3498db;
        border-color: #3498db;
        color: #fff;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
    }
    
    .btn-primary:hover {
        background: #2980b9;
        border-color: #2980b9;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
    }
    
    .btn-primary i {
        margin-right: 8px;
    }
    
    /* Search */
    .search-wrapper {
        position: relative;
        margin-bottom: 20px;
    }
    
    .search-wrapper input {
        padding-left: 40px;
        border-radius: 10px;
        border: 2px solid #e9ecef;
        padding: 10px 15px 10px 40px;
        transition: all 0.3s ease;
        background: #fafbfc;
    }
    
    .search-wrapper input:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.15);
        background: #ffffff;
    }
    
    .search-wrapper i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #adb5bd;
        font-size: 16px;
    }
    
    /* Header Section */
    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .header-section .left {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }
    
    .empty-state i {
        font-size: 64px;
        color: #d1d5db;
        margin-bottom: 15px;
    }
    
    .empty-state h5 {
        color: #374151;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .empty-state p {
        color: #6b7280;
        margin-bottom: 20px;
    }
    
    /* Info Total */
    .info-total {
        color: #6c757d;
        font-size: 13px;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #e9ecef;
    }
    
    .info-total strong {
        color: #2c3e50;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .card-body {
            padding: 15px;
        }
        
        .header-section {
            flex-direction: column;
            align-items: stretch;
        }
        
        .header-section .left {
            flex-direction: column;
            align-items: stretch;
        }
        
        .table {
            font-size: 13px;
        }
        
        .table thead th,
        .table tbody td {
            padding: 8px 10px;
        }
        
        .cover-thumb {
            width: 40px;
            height: 40px;
        }
        
        .btn-group .btn {
            padding: 4px 8px;
            font-size: 11px;
        }
        
        .btn-primary {
            padding: 8px 15px;
            font-size: 13px;
            width: 100%;
            text-align: center;
        }
    }
    
    @media (max-width: 576px) {
        .table-responsive {
            font-size: 12px;
        }
        
        .table thead th,
        .table tbody td {
            padding: 6px 8px;
        }
        
        .cover-thumb {
            width: 35px;
            height: 35px;
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
                        <!-- Header -->
                        <div class="header-section">
                            <div class="left">
                                <h4 class="card-title">
                                    <i class="fas fa-images" style="color: #3498db; margin-right: 10px;"></i>
                                    Data Album Galeri
                                </h4>
                                <span class="badge badge-primary badge-pill">{{ $albums->count() }} Album</span>
                            </div>
                            <a href="{{ route('gallery.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Album
                            </a>
                        </div>

                        <!-- Notification -->
                        @if(session('notification'))
                            <div class="alert alert-{{ session('notification.type') == 'error' ? 'danger' : session('notification.type') }} alert-dismissible fade show" role="alert">
                                <i class="fas {{ session('notification.type') == 'success' ? 'fa-check-circle' : 'fa-exclamation-circle' }}"></i>
                                <strong>{{ session('notification.title') }}</strong>
                                <p class="mb-0">{{ session('notification.text') }}</p>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <!-- Search -->
                        <div class="search-wrapper">
                            <i class="fas fa-search"></i>
                            <input id="searchInput" class="form-control" type="search" 
                                   placeholder="Cari album berdasarkan nama, lokasi, atau tanggal..." 
                                   aria-label="Search">
                        </div>

                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-center">
                                        <th style="width: 50px;">No</th>
                                        <th style="width: 70px;">Cover</th>
                                        <th>Nama Album</th>
                                        <th>Lokasi</th>
                                        <th>Tanggal</th>
                                        <th style="width: 100px;">Jumlah Foto</th>
                                        <th style="width: 140px;">Dibuat</th>
                                        <th style="width: 130px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($albums as $no => $album)
                                        <tr>
                                            <td class="text-center font-weight-bold">{{ ++$no }}</td>
                                            <td class="text-center">
                                                @if($album->cover_image && file_exists(public_path($album->cover_image)))
                                                    <img src="{{ asset($album->cover_image) }}" 
                                                         alt="{{ $album->nama_album }}" 
                                                         class="cover-thumb"
                                                         onerror="this.onerror=null; this.src='{{ asset('img/default-album.jpg') }}'">
                                                @else
                                                    <div class="cover-placeholder">
                                                        <i class="fas fa-image"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $album->nama_album }}</strong>
                                                @if($album->deskripsi)
                                                    <br>
                                                    <small class="text-muted">{{ Str::limit($album->deskripsi, 50) }}</small>
                                                @endif
                                            </td>
                                            <td>{{ $album->lokasi ?? '-' }}</td>
                                            <td>{{ $album->tanggal ? \Carbon\Carbon::parse($album->tanggal)->format('d/m/Y') : '-' }}</td>
                                            <td class="text-center">
                                                <span class="badge-photo">
                                                    <i class="fas fa-camera"></i> {{ $album->photos_count }}
                                                </span>
                                            </td>
                                            <td>
                                                <small>{{ $album->created_at->format('d/m/Y H:i') }}</small>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('gallery.show', $album->id) }}" 
                                                       class="btn btn-info btn-sm" 
                                                       title="Lihat Foto" 
                                                       data-toggle="tooltip">
                                                        <i class="fas fa-images"></i>
                                                    </a>
                                                    <a href="{{ route('gallery.edit', $album->id) }}" 
                                                       class="btn btn-warning btn-sm" 
                                                       title="Edit" 
                                                       data-toggle="tooltip">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" 
                                                            class="btn btn-danger btn-sm" 
                                                            onclick="confirmDelete('{{ $album->id }}', '{{ $album->nama_album }}')" 
                                                            title="Hapus" 
                                                            data-toggle="tooltip">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                                
                                                <!-- Form Delete -->
                                                <form id="deleteForm-{{ $album->id }}" 
                                                      method="POST" 
                                                      action="{{ route('gallery.destroy', $album->id) }}" 
                                                      style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center py-5">
                                                <div class="empty-state">
                                                    <i class="fas fa-images"></i>
                                                    <h5>Belum Ada Album Galeri</h5>
                                                    <p>Silahkan klik tombol <strong>"Tambah Album"</strong> untuk menambahkan album baru.</p>
                                                    <a href="{{ route('gallery.create') }}" class="btn btn-primary">
                                                        <i class="fas fa-plus"></i> Tambah Album Sekarang
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Info Total -->
                        @if($albums->count() > 0)
                            <div class="info-total">
                                <i class="fas fa-info-circle"></i> 
                                Menampilkan <strong>{{ $albums->count() }}</strong> album 
                                dari total <strong>{{ $albums->count() }}</strong> album
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
    // Search Function
    $(document).ready(function() {
        $('#searchInput').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('table tbody tr').filter(function() {
                var text = $(this).text().toLowerCase();
                $(this).toggle(text.indexOf(value) > -1);
            });
            
            // Show/hide empty message
            var visibleRows = $('table tbody tr:visible').length;
            if (visibleRows === 0 && $('table tbody tr').length > 0) {
                // Jika tidak ada hasil pencarian
                if ($('#noResult').length === 0) {
                    $('table tbody').append(`
                        <tr id="noResult">
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-search fa-2x text-muted mb-2"></i>
                                <h6>Tidak ada hasil pencarian</h6>
                                <p class="text-muted">Coba dengan kata kunci lain</p>
                            </td>
                        </tr>
                    `);
                }
            } else {
                $('#noResult').remove();
            }
        });

        // Tooltip
        $('[data-toggle="tooltip"]').tooltip();

        // Auto dismiss alert
        setTimeout(function() {
            $('.alert').fadeOut('slow');
        }, 5000);
    });

    // Delete Confirmation
    function confirmDelete(id, name) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            html: `Album "<strong>${name}</strong>" dan semua fotonya akan dihapus!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Tampilkan loading
                Swal.fire({
                    title: 'Menghapus...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
                
                // Submit form
                document.getElementById('deleteForm-' + id).submit();
            }
        });
    }

    // Notification from session
    @if(session('notification'))
        $(document).ready(function() {
            Swal.fire({
                icon: '{{ session('notification.type') }}',
                title: '{{ session('notification.title') }}',
                text: '{{ session('notification.text') }}',
                timer: 3000,
                timerProgressBar: true,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
            });
        });
    @endif
</script>
@endpush
@endsection
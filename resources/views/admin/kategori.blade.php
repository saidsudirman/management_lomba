@extends('layout.app')

@section('title', 'Data Kategori')

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @if (session('success'))
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Sukses!',
                                        text: '{{ session('success') }}',
                                        showConfirmButton: false,
                                        timer: 3000
                                    });
                                });
                            </script>
                        @endif

                        @if (session('error'))
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal!',
                                        text: '{{ session('error') }}',
                                        showConfirmButton: true
                                    });
                                });
                            </script>
                        @endif

                        <div class="card-body">
                            <h4 class="card-title">Data Kategori Lomba</h4>

                            <div class="text-right mb-3">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                                    <i class="fas fa-plus"></i> Tambah Kategori
                                </button>
                            </div>

                            <div class="search-element mb-3">
                                <input id="searchInput" class="form-control" type="search" placeholder="Search" aria-label="Search">
                            </div>

                            <div class="table-responsive">
                                <table id="example" class="table table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama Kategori</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kategoris as $no => $kat)
                                            <tr>
                                                <td class="text-center">{{ $no + 1 }}</td>
                                                <td class="text-center">{{ $kat->nama_kategori }}</td>
                                                <td class="text-center">
                                                    <button data-toggle="modal" data-target="#editKategoriModal{{ $kat->id }}" type="button" class="btn btn-info">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <form id="deleteForm-{{ $kat->id }}" method="POST" action="{{ route('admin.kategori.destroy', $kat) }}" style="display:inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $kat->id }}')">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Kategori -->
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Tambah Kategori Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.kategori.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nama_kategori">Nama Kategori</label>
                                <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Kategori -->
        @foreach ($kategoris as $kat)
            <div class="modal fade" id="editKategoriModal{{ $kat->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Kategori</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.kategori.update', $kat) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="edit_nama_kategori_{{ $kat->id }}">Nama Kategori</label>
                                    <input type="text" class="form-control" id="edit_nama_kategori_{{ $kat->id }}" name="nama_kategori" value="{{ $kat->nama_kategori }}" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-save"></i> Update
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <script>
            $(document).ready(function() {
                $('#searchInput').on('keyup', function() {
                    var value = $(this).val().toLowerCase();
                    $('table tbody tr').filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                    });
                });
            });

            function confirmDelete(id) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('deleteForm-' + id).submit();
                    }
                });
            }
        </script>
@endsection
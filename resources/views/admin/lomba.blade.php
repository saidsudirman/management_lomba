@extends('layout.app')

@section('title', 'Lomba')

@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Lomba</h4>

                        <div class="text-right mb-3">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                                Tambah Lomba
                            </button>
                        </div>

                        <div class="mb-3">
                            <input id="searchInput" class="form-control" type="search" placeholder="Cari Lomba" aria-label="Search">
                        </div>

                        <div class="table-responsive">
                            <table id="example" class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Foto</th>
                                        <th>Harga</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lomba as $no => $lmb)
                                        <tr>
                                            <td class="text-center">{{ ++$no }}</td>
                                            <td class="text-center">{{ $lmb->nama }}</td>
                                            <td class="text-center">{{ $lmb->tanggal_mulai }}</td>
                                            <td class="text-center">{{ $lmb->tanggal_selesai }}</td>
                                            <td class="text-center">
                                                <button data-toggle="modal" data-target="#detailModal{{ $lmb->id }}" class="btn btn-info btn-sm">Lihat</button>
                                            </td>
                                            <td class="text-center">{{ 'Rp ' . number_format($lmb->harga, 0, ',', '.') }}</td>
                                            <td class="text-center">{{ Str::limit($lmb->deskripsi, 50) }}</td>
                                            <td class="text-center">
                                                <form id="deleteForm-{{ $lmb->id }}" method="POST" action="{{ route('lomba.destroy', $lmb->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ $lmb->id }}')">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Modal Detail -->
                                        <div class="modal fade" id="detailModal{{ $lmb->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detail Foto</h5>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <img src="{{ asset($lmb->foto) }}" alt="Foto Lomba" class="img-fluid">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Modal Tambah Lomba -->
                        <div class="modal fade" id="createModal" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Lomba</h5>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <form action="{{ route('lomba.create') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Nama Lomba</label>
                                                <input type="text" name="nama" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Mulai</label>
                                                <input type="date" name="tanggal_mulai" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Tanggal Selesai</label>
                                                <input type="date" name="tanggal_selesai" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Foto</label>
                                                <input type="file" name="foto" class="form-control" accept="image/*" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Harga</label>
                                                <input type="text" name="harga" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <textarea name="deskripsi" class="form-control" required></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Confirmation -->
                        <script>
                            function confirmDelete(id) {
                                Swal.fire({
                                    title: 'Yakin ingin menghapus?',
                                    text: "Data tidak dapat dikembalikan!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Ya, hapus!'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        document.getElementById('deleteForm-' + id).submit();
                                    }
                                });
                            }
                        </script>

                        <script>
                            $(document).ready(function() {
                                $('#searchInput').on('keyup', function() {
                                    var value = $(this).val().toLowerCase();
                                    $('table tbody tr').filter(function() {
                                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                                    });
                                });
                            });
                        </script>

                        @if (session('notification'))
                            <script>
                                $(document).ready(function() {
                                    const notif = @json(session('notification'));
                                    Swal.fire(notif.title, notif.text, notif.type);
                                });
                            </script>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

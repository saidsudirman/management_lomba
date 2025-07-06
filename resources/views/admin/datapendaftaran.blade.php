@extends('layout.app')

@section('title', 'Data Pendaftaran')

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

                    <div class="card-body">
                        <h4 class="card-title">Data Pendaftaran</h4>

                        <div class="search-element">
                            <input id="searchInput" class="form-control" type="search" placeholder="Search" aria-label="Search">
                        </div>

                        <br>

                        <div class="table-responsive">
                            <table id="example" class="table table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Peserta</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">No HP</th>
                                        <th class="text-center">Jenis Kelamin</th>
                                        <th class="text-center">Tanggal Lahir</th>
                                        <th class="text-center">Alamat</th>
                                        <th class="text-center">Asal Sekolah</th>
                                        <th class="text-center">Id Lomba</th>
                                        <th class="text-center">Status Pembayaran</th>
                                        <th class="text-center">Tanggal Pendaftaran</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pendaftaran as $index => $pen)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td class="text-center">{{ $pen->nama_peserta }}</td>
                                            <td class="text-center">{{ $pen->email }}</td>
                                            <td class="text-center">{{ $pen->no_hp }}</td>
                                            <td class="text_center">{{ $pen->jenis_kelamin}}</td>
                                            <td class="text-center">{{ $pen->tanggal_lahir }}</td>
                                            <td class="text-center">{{ $pen->alamat }}</td>
                                            <td class="text-center">{{ $pen->asal_sekolah }}</td>
                                            <td class="text-center">{{ $pen->id_lomba }}</td>
                                            <td class="text-center">
                                                @if ($pen->status_pembayaran == '1')
                                                    Belum Bayar
                                                @elseif ($pen->status_pembayaran == '2')
                                                    Sudah Bayar
                                                @endif
                                            <td class="text-center">{{ $pen->tanggal_pendaftaran }}</td>
                                            <td class="align-middle text-center">
                                                <button data-toggle="modal" data-target="#editPendaftaranModal{{ $pen->id }}" class="btn btn-info">Edit</button>
                                                <form id="deleteForm-{{ $pen->id }}" method="POST" action="{{ route('pendaftaran.destroy', $pen->id) }}" style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $pen->id }}')">Delete</button>
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

    @foreach ($pendaftaran as $pen)
        <div class="modal fade" id="editPendaftaranModal{{ $pen->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('pendaftaran.update', $pen->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Nama Peserta</label>
                                <input type="text" name="username" class="form-control" value="{{ $pen->nama_peserta }}">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $pen->email }}">
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <input type="text" name="alamat" class="form-control" value="{{ $pen->alamat }}">
                            </div>
                            <div class="form-group">
                                <label>Nomor Telepon</label>
                                <input type="text" name="no_hp" class="form-control" value="{{ $pen->no_hp }}">
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <input type="text" name="jenis_kelamin" class="form-control" value="{{ $pen->jenis_kelamin }}">
                            </div>
                            <div class="form-group">
                                <label>Asal Sekolah</label>
                                <input type="text" name="asal_sekolah" class="form-control" value="{{ $pen->asal_sekolah }}">
                            </div>
                            <div class="form-group">
                                <label>Status Pembayaran</label>
                                <select name="status_pembayaran" class="form-control">
                                    <option value="1" {{ $pen->status_pembayaran == '1' ? 'selected' : '' }}>Belum Bayar</option>
                                    <option value="2" {{ $pen->status_pembayaran == '2' ? 'selected' : '' }}>Sudah Bayar</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Lomba</label>
                                <select name="id_lomba" class="form-control">
                                    @foreach ($lombas as $lomba)
                                        <option value="{{ $lomba->id }}" {{ $pen->id_lomba == $lomba->id ? 'selected' : '' }}>{{ $lomba->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data yang dihapus tidak dapat dikembalikan!',
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

        $(document).ready(function () {
            $('#searchInput').on('keyup', function () {
                var value = $(this).val().toLowerCase();
                $('table tbody tr').filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
</div>
@endsection

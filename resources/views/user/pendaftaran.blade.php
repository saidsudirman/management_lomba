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
                            @if (Auth::user()->status == '1')
                                <div class="align-right text-right">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                                        Tambah Pengguna
                                    </button>
                                </div>
                            @endif
                            <br>
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
                                            <th class="text-center">Alamat</th>
                                            <th class="text-center">Asal Sekolah</th>
                                            <th class="text-center">Nama Lomba</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Status Pembayaran</th>
                                            <th class="text-center">Tanggal Pendaftaran</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($userpendaftaran as $no => $pen)
                                        <tr>
                                            <td class="text-center">{{ ++$no }}</td>
                                            <td class="text-center">{{ $pen->nama_peserta }}</td>
                                            <td class="text-center">{{ $pen->email }}</td>
                                            <td class="text-center">{{ $pen->no_hp }}</td>
                                            <td class="text-center">{{ $pen->jenis_kelamin }}</td>
                                            <td class="text-center">{{ $pen->alamat }}</td>
                                            <td class="text-center">{{ $pen->asal_sekolah }}</td>
                                            <td class="text-center">{{ $pen->lomba->nama }}</td>
                                            <td class="text-center">{{ number_format($pen->lomba->harga, 0, ',', '.') }}</td>
                                            <td class="text-center">
                                                @if ($pen->status_pembayaran == '1')
                                                    <span class="badge badge-danger">Belum Bayar</span>
                                                @else
                                                    <span class="badge badge-success">Sudah Bayar</span>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $pen->tanggal_pendaftaran }}</td>
                                            <td class="align-middle text-center">
                                                {{-- tombol aksi --}}
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function goToPayment(userId) {
            window.location.href = '/payment/create/' + userId;
        }

        function printDocument(userId) {
            window.open('/cetak-pendaftaran/' + userId, '_blank');
        }

        function confirmDelete(userId) {
            Swal.fire({
                title: 'Yakin Mo Ngapus Bro?',
                text: "Nggak bakal bisa balik lo",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm-' + userId).submit();
                }
            });
        }
    </script>

    @include('admin.pendaftaran-modal')

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
@endsection

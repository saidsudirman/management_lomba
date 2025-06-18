@extends('layout.app')

@section('title', 'User')

@section('content')
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Data User</h4>

                            <div class="text-right mb-3">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#createUserModal">
                                    Tambah Pengguna
                                </button>
                            </div>

                            <div class="search-element mb-3">
                                <input id="searchInput" class="form-control" type="search" placeholder="Search"
                                    aria-label="Search">
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Username</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Password</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admin as $no => $item)
                                            <tr>
                                                <td class="text-center">{{ $no + 1 }}</td>
                                                <td class="text-center">{{ $item->username }}</td>
                                                <td class="text-center">{{ $item->email }}</td>
                                                <td class="text-center">******</td>
                                                <td class="text-center">
                                                    <button data-toggle="modal"
                                                        data-target="#editUserModal{{ $item->id }}"
                                                        class="btn btn-info btn-sm">Edit</button>

                                                    <form id="deleteForm-{{ $item->id }}" method="POST"
                                                        action="{{ route('user.destroy', $item->id) }}"
                                                        style="display:inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete('{{ $item->id }}')">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Modal Tambah User -->
                            <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog"
                                aria-labelledby="createUserModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('user.store') }}" method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="createUserModalLabel">Tambah Pengguna</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Username:</label>
                                                    <input type="text" class="form-control" name="username" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Email:</label>
                                                    <input type="email" class="form-control" name="email" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Password:</label>
                                                    <input type="password" class="form-control" name="password" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Tambah</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Edit User -->
                            @foreach ($admin as $item)
                                <div class="modal fade" id="editUserModal{{ $item->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="editUserModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('user.update', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Pengguna</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Username:</label>
                                                        <input type="text" class="form-control" name="username"
                                                            value="{{ $item->username }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email:</label>
                                                        <input type="email" class="form-control" name="email"
                                                            value="{{ $item->email }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password (opsional):</label>
                                                        <input type="password" class="form-control" name="password"
                                                            placeholder="Kosongkan jika tidak diubah">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert untuk konfirmasi hapus -->
    <script>
        function confirmDelete(userId) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm-' + userId).submit();
                }
            });
        }

        // Search filter
        $(document).ready(function() {
            $('#searchInput').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('table tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });

        // Notifikasi session
        @if (session('notification'))
            $(document).ready(function() {
                const { title, text, type } = @json(session('notification'));
                Swal.fire(title, text, type);
            });
        @endif
    </script>
@endsection

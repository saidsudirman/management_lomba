@extends('layout.landing.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Formulir Pendaftaran Lomba</h2>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pendaftaran.storeLanding') }}" method="POST" autocomplete="off">
        @csrf

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="username">Nama Peserta</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" 
                       id="username" name="username" value="{{ old('username') }}" required>
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control @error('alamat') is-invalid @enderror" 
                   id="alamat" name="alamat" value="{{ old('alamat') }}" required>
            @error('alamat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nisn">NISN</label>
                <input type="text" class="form-control @error('nisn') is-invalid @enderror" 
                       id="nisn" name="nisn" value="{{ old('nisn') }}" required>
                @error('nisn')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                       id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                @error('tanggal_lahir')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="kategori_id">Kategori</label>
                <select id="kategori_id" class="form-control" name="kategori_id" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="id_lomba">Lomba</label>
                <select id="id_lomba" class="form-control @error('id_lomba') is-invalid @enderror" name="id_lomba" required>
                    <option value="">Pilih Lomba</option>
                </select>
                @error('id_lomba')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="no_hp">Nomor Telepon</label>
                <input type="text" class="form-control @error('no_hp') is-invalid @enderror" 
                       id="no_hp" name="no_hp" value="{{ old('no_hp') }}" required>
                @error('no_hp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="asal_sekolah">Asal Sekolah</label>
            <input type="text" class="form-control @error('asal_sekolah') is-invalid @enderror" 
                   id="asal_sekolah" name="asal_sekolah" value="{{ old('asal_sekolah') }}" required>
            @error('asal_sekolah')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="alert alert-info mt-4">
            <h6>Transfer ke Nomor Rekening Panitia: 1234567890</h6>
            <p class="mb-0">Setelah mendaftar, silakan melakukan pembayaran untuk menyelesaikan proses pendaftaran.</p>
        </div>

        <button type="submit" class="btn btn-primary btn-block mt-3">
            <i class="fas fa-user-plus mr-2"></i> Daftarkan Sekarang
        </button>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById('kategori_id').addEventListener('change', function () {
                var kategoriId = this.value;
                var selectLomba = document.getElementById('id_lomba');

                // Kosongkan opsi dulu
                selectLomba.innerHTML = '<option value="">Pilih Lomba</option>';

                if (kategoriId) {
                    fetch('/get-lomba-by-kategori/' + kategoriId)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(function (lomba) {
                                var option = document.createElement('option');
                                option.value = lomba.id;
                                option.text = lomba.nama;
                                selectLomba.appendChild(option);
                            });
                        });
                }
            });
        });
    </script>
</div>
@endsection
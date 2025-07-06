@extends('layout.landing.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Pendaftaran IMPAS EDUCATION #13</h2>
    
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
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                       id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                @error('tanggal_lahir')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group col-md-6">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select id="jenis_kelamin" name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="id_lomba">Pilih Materi</label>
                <select id="id_lomba" class="form-control @error('id_lomba') is-invalid @enderror" name="id_lomba" required>
                    <option value="">Pilih Materi</option>
                    @foreach ($lombas as $lomba)
                        <option value="{{ $lomba->id }}" {{ old('id_lomba') == $lomba->id ? 'selected' : '' }}>
                            {{ $lomba->nama }}
                        </option>
                    @endforeach
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
            <p class="mb-0">Setelah mendaftar, Setalah itu Silahkan bawa kertas Pendaftaran ke stand dan juga membayar registrasi ikut kegiatan</p>
        </div>

        <button type="submit" class="btn btn-primary btn-block mt-3">
            <i class="fas fa-user-plus mr-2"></i> Daftarkan Sekarang
        </button>
    </form>
</div>
@endsection

@extends('layout.landing.app')

@section('content')

<div class="container py-5">
    <h2 class="text-center mb-4">Formulir Pendaftaran Lomba</h2>
    
    <form action="{{ route('pendaftaran.storeLanding') }}" method="POST" autocomplete="off">
        @csrf

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="username">Nama Peserta</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nisn">NISN</label>
                <input type="text" class="form-control" id="nisn" name="nisn" required>
            </div>

            <div class="form-group col-md-6">
                <label for="id_lomba">Lomba</label>
                <select id="id_lomba" class="form-control" name="id_lomba" required>
                    <option value="">Pilih Lomba</option>
                    @foreach ($lombas as $lomba)
                        <option value="{{ $lomba->id }}">{{ $lomba->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="no_hp">Nomor Telepon</label>
                <input type="text" class="form-control" id="no_hp" name="no_hp" required>
            </div>

            <div class="form-group col-md-6">
                <label for="asal_sekolah">Asal Sekolah</label>
                <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" required>
            </div>
        </div>

        <div>
            <h6>Transfer Di Nomor Rekening Panitia= 1234567890</h6>
        </div>

        <button type="submit" class="btn btn-primary btn-block mt-3">
            Daftarkan data diri anda
        </button>
    </form>
</div>

@endsection

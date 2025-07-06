<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_lomba');
            $table->string('nama_peserta');
            $table->string('email')->unique();
            $table->string('no_hp', 15);
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->text('alamat');
            $table->string('asal_sekolah');
            $table->date('tanggal_lahir');
            $table->enum('status_pembayaran', ['1', '2'])->default('1')->comment('1=Belum Bayar, 2=Sudah Bayar');
            $table->dateTime('tanggal_pendaftaran');
            $table->timestamps();

            $table->foreign('id_lomba')->references('id')->on('lomba')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('master_mahasiswas', function (Blueprint $table) {
            $table->id();
            // $table->string('nim', 20)->unique();
            $table->string('nama_mahasiswa');
            $table->enum('jenis_kelamin', ['L', 'P'])->default('L');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('nik');
            $table->string('nisn')->nullable();
            $table->string('npwp')->nullable();
            $table->string('kewarganegaraan')->nullable();
            $table->string('jalan')->nullable();
            $table->string('dusun')->nullable()->comment('nama dusun atau nama lingkungan');
            $table->string('rt');
            $table->string('rw');
            $table->string('kelurahan')->comment('nama desa atau kelurahan');
            $table->string('kode_pos')->nullable()->comment('');
            $table->unsignedInteger('id_wilayah')->comment('id wilayah dari master_wilayah');
            $table->unsignedInteger('id_jenis_tinggal')->comment('id jenis tinggal dari master_jenis_tinggal');
            $table->unsignedInteger('id_alat_transportasi')->nullable()->comment('id alat transportasi dari master_alat_transportasi');
            $table->string('telepon')->nullable();
            $table->string('handphone')->nullable();
            $table->string('email')->nullable();
            $table->boolean('penerima_kps')->default(false)->comment('status kps mahasiswa');
            $table->unsignedInteger('id_kebutuhan_khusus_mahasiswa')->nullable()->comment('id kebutuhan khusus mahasiswa dari master_kebutuhan_khusus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations
     */
    public function down(): void
    {
        Schema::dropIfExists('master_mahasiswas');
    }
};

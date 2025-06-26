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
        Schema::create('mahasiswa_orang_tuas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('id_mahasiswa')->comment('id mahasiswa dari master_mahasiswas');
            $table->string('nik')->nullable()->comment('NIK hanya mandatori untuk orang tua');
            $table->string('nama');
            $table->unsignedInteger('id_pendidikan')->comment('id pendidikan dari master_pendidikan');
            $table->unsignedInteger('id_pekerjaan')->comment('id pekerjaan dari master_pekerjaan');
            $table->unsignedInteger('id_penghasilan')->comment('id penghasilan dari master_penghasilan');
            $table->enum('hubungan', ['Ayah', 'Ibu', 'Wali'])->default('Ayah')->comment('hubungan orang tua dengan mahasiswa');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_orang_tuas');
    }
};

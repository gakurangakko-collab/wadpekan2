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
        if (! Schema::hasTable('penghuni_kost')) {
            Schema::create('penghuni_kost', function (Blueprint $table) {
                $table->id();
                $table->string('nama', 50);
                $table->string('nik', 20);
                $table->string('jk', 100);
                $table->string('telepon', 20);
                $table->string('pekerjaan', 100)->nullable();
                $table->string('kamar', 50);
                $table->date('tgl_masuk');
                $table->string('harga', 20);
                $table->string('kontak_darurat', 100);
                $table->enum('status', ['Lunas', 'Belum lunas', 'Nunggak'])->default('Belum lunas');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penghuni_kost');
    }
};

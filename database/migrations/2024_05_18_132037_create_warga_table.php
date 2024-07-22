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
        Schema::create('warga', function (Blueprint $table) {
            $table->increments('id_warga');
            $table->string('nama_warga');
            $table->string('no_hp_warga', 20);
            $table->string('blok');
            $table->string('alamat');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->integer('rt');
            $table->integer('rw');
            $table->timestamp('tgl_warga')->useCurrent();
            $table->timestamp('tgl_update_warga')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warga');
    }
};

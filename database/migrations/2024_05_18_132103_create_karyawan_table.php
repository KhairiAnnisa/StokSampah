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
        Schema::create('karyawan', function (Blueprint $table) {
            $table->increments('id_karyawan');
            $table->string('nama_karyawan');
            $table->string('alamat');
            $table->string('posisi');
            $table->string('no_hp', 20);
            $table->timestamp('tgl_karyawan')->useCurrent();
            $table->timestamp('tgl_update_karyawan')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};

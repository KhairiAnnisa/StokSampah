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
        Schema::create('laporan', function (Blueprint $table) {
            $table->increments('id_laporan');
            $table->integer('upah');
            $table->integer('thr');
            $table->unsignedInteger('id_karyawan');
            $table->timestamp('tgl_gaji')->useCurrent();
            $table->timestamp('tgl_update_gaji')->useCurrentOnUpdate()->useCurrent();

            $table->foreign('id_karyawan')->references('id_karyawan')->on('karyawan')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

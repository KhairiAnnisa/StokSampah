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
        Schema::create('sampah', function (Blueprint $table) {
            $table->increments('id_sampah');
            $table->string('nama_sampah');
            $table->integer('stok_sampah');
            $table->enum('kategori', ['anorganik', 'organik']);
            $table->timestamp('tgl_sampah')->useCurrent();
            $table->timestamp('tgl_update_sampah')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sampah');
    }
};

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
        Schema::create('sampahkeluar', function (Blueprint $table) {
            $table->increments('id_sampahkeluar');            
            $table->unsignedInteger('id_sampah');
            $table->integer('harga_sampahkeluar');
            $table->integer('berat_sampahkeluar');
            $table->integer('total_sampahkeluar');
            $table->enum('jenis', ['penjualan_sampah', 'penjualan_magot']);
            $table->timestamp('tgl_sampahkeluar')->useCurrent();
            $table->timestamp('tgl_update_sampahkeluar')->useCurrentOnUpdate()->useCurrent();

            $table->foreign('id_sampah')->references('id_sampah')->on('sampah')
                ->onDelete('cascade');
            
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sampahkeluar');
    }
};

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
        Schema::create('sampahmasuk', function (Blueprint $table) {
            $table->increments('id_sampahmasuk');
            $table->integer('total_sampahmasuk');
            $table->unsignedInteger('id_sampah');
            $table->unsignedInteger('id_sampahkotor');
            $table->timestamp('tgl_sampahmasuk')->useCurrent();
            $table->timestamp('tgl_update_sampahmasuk')->useCurrentOnUpdate()->useCurrent();

            $table->foreign('id_sampahkotor')->references('id_sampahkotor')->on('sampahkotor')
                ->onDelete('cascade');
            $table->foreign('id_sampah')->references('id_sampah')->on('sampah')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sampahmasuk');
    }
};

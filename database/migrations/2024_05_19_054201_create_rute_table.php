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
        Schema::create('rute', function (Blueprint $table) {
            $table->increments('id_rute');
            $table->string('nama_rute');
            $table->string('detail_rute');            
            $table->timestamp('tgl_rute')->useCurrent();
            $table->timestamp('tgl_update_rute')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rute');
    }
};

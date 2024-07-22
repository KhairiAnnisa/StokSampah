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
        Schema::create('sampahkotor', function (Blueprint $table) {
            $table->increments('id_sampahkotor');            
            $table->unsignedInteger('id_rute');
            $table->integer('total_berat');                
            $table->timestamp('tgl_sampahkotor')->useCurrent();
            $table->timestamp('tgl_update_sampahkotor')->useCurrentOnUpdate()->useCurrent();

            $table->foreign('id_rute')->references('id_rute')->on('rute')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sampahkotor');
    }
};

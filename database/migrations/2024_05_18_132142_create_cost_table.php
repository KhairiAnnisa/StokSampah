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
        Schema::create('cost', function (Blueprint $table) {
            $table->increments('id_cost');
            $table->string('nama_pengeluaran');
            $table->integer('biaya');
            $table->timestamp('tgl_cost')->useCurrent();
            $table->timestamp('tgl_update_cost')->useCurrentOnUpdate()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cost');
    }
};

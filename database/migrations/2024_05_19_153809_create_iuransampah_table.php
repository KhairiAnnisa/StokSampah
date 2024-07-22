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
        Schema::create('iuransampah', function (Blueprint $table) {
            $table->increments('id_iuransampah');
            $table->unsignedInteger('id_warga');
            $table->string('bulan');
            $table->enum('status', ['belum_lunas', 'lunas']);
            $table->integer('harga');
            $table->timestamp('tgl_iuransampah')->useCurrent();
            $table->timestamp('tgl_update_iuransampah')->useCurrentOnUpdate()->useCurrent();

            $table->foreign('id_warga')->references('id_warga')->on('warga')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iuransampah');
    }
};

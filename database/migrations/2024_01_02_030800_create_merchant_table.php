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
        Schema::create('merchant', function (Blueprint $table) {
            $table->id('merchant_id');
            $table->string('uuid');
            $table->string('email');
            $table->string('no_hp');
            $table->string('nama_toko');
            $table->string('alamat');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('kelurahan');
            $table->string('kode_pos');
            $table->string('logo');
            $table->string('banner');
            $table->string('keterangan');
            $table->string('rating');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchant');
    }
};

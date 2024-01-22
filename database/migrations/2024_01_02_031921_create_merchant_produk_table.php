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
        Schema::create('merchant_produk', function (Blueprint $table) {
            $table->id('merchant_produk_id');
            $table->integer('merchant_id');
            $table->string('uuid',100);
            $table->string('nama_produk',100);
            $table->text('keterangan');
            $table->integer('harga');
            $table->double('diskon');
            $table->integer('harga_jual');
            $table->integer('stok');
            $table->integer('kategori_id');
            $table->double('rating');
            $table->integer('terjual');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchant_produk');
    }
};

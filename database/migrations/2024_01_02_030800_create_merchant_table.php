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
            $table->string('email',20);
            $table->string('password',50);
            $table->string('no_hp',30);
            $table->string('nama_toko',20);
            $table->string('alamat',100);
            $table->string('provinsi',20);
            $table->string('kota',20);
            $table->string('kelurahan',20);
            $table->string('kode_pos',10);
            $table->string('logo',30);
            $table->string('banner',30);
            $table->string('keterangan',100);
            $table->double('rating');
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

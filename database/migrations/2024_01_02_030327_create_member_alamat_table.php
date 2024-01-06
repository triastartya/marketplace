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
        Schema::create('member_alamat', function (Blueprint $table) {
            $table->id('member_alamat_id');
            $table->string('uuid');
            $table->string('nama');
            $table->string('no_hp');
            $table->string('alamat');
            $table->string('detail');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('kelurahan');
            $table->string('kodepos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_alamat');
    }
};

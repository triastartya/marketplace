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
            $table->integer('member_id');
            $table->string('uuid',100);
            $table->string('nama',30);
            $table->string('no_hp',30);
            $table->string('alamat',100);
            $table->string('detail',200);
            $table->string('provinsi',20);
            $table->string('kota',20);
            $table->string('kelurahan',20);
            $table->string('kodepos',10);
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

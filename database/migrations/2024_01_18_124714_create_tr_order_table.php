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
        Schema::create('tr_order', function (Blueprint $table) {
            $table->id('tr_order_id');
            $table->date('tanggal_order');
            $table->string('uuid',100);
            $table->string('no_invoice',50);
            $table->integer('member_id');
            $table->string('keterangan',100);
            $table->integer('total_bayar');
            $table->integer('jml');
            $table->integer('status');
            $table->string('status_bayar',20);
            $table->string('bukti_transfer',30)->nullable();
            $table->datetime('tgl_bukti_transfer')->nullable();
            $table->datetime('tgl_verifikasi')->nullable();
            $table->integer('user_id_verifikasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_order');
    }
};

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
        Schema::create('tr_order_detail', function (Blueprint $table) {
            $table->id('tr_order_detail_id');
            $table->integer('tr_order_id');
            $table->integer('merchant_id');
            $table->integer('member_id');
            $table->integer('merchant_produk_id');
            $table->string('no_order');
            $table->integer('qty');
            $table->integer('harga');
            $table->integer('total_harga');
            $table->integer('status');
            $table->string('status_pengiriman',20);
            $table->integer('rating');
            $table->string('review',100);
            $table->datetime('tgl_lunas');
            $table->datetime('tgl_dikirim');
            $table->datetime('tgl_diterima');
            $table->datetime('tgl_cair');
            $table->integer('user_id_cair');
            $table->string('bukti_transfer',100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_order_detail');
    }
};

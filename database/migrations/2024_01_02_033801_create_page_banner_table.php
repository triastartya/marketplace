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
        Schema::create('page_banner', function (Blueprint $table) {
            $table->id();
            $table->string('uuid',100);
            $table->string('gambar',50);
            $table->string('slug',100);
            $table->string('judul',50);
            $table->text('detail');
            $table->boolean('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_banner');
    }
};

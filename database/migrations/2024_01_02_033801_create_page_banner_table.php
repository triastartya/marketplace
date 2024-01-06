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
            $table->string('uuid');
            $table->string('gambar');
            $table->string('slug');
            $table->string('judul');
            $table->string('detail');
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

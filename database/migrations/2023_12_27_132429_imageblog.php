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
        Schema::create('imageblog', function (Blueprint $table) {
            $table->id('maIB');
            $table->foreignId('idblog')->references('maBlog')->on('blog')
                ->onDelete('cascade')->onUpdate('cascade'); 
            $table->binary('image')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imageblog');
    }
};
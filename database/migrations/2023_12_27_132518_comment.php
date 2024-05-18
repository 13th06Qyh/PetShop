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
        Schema::create('comment', function (Blueprint $table) {
            $table->id('maBL');
            $table->foreignId('iduser')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('idblog')->references('maBlog')->on('blog')
                ->onDelete('cascade')->onUpdate('cascade');    
            $table->string('noidungbl')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment');
    }
};
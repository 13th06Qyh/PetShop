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
        Schema::create('imagesp', function (Blueprint $table) {
            $table->id('maISP');
            $table->foreignId('idsp')->references('maSP')->on('sanpham')
                ->onDelete('cascade')->onUpdate('cascade'); 
            $table->string('image')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagesp');
    }
};
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
        Schema::create('bill_sp', function (Blueprint $table) {
            $table->id('maBillSP');
            $table->foreignId('idsp')->references('maSP')->on('sanpham')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('idbill')->references('maBill')->on('bill')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->integer('soluong')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_sp');
    }
};
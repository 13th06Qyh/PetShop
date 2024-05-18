<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sanpham', function (Blueprint $table) {
            $table->id('maSP');
            $table
                ->foreignId('idanimal')
                ->references('maAnimal')
                ->on('animal')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreignId('idtag')
                ->references('maTag')
                ->on('tag')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreignId('idtype')
                ->references('maType')
                ->on('type')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreignId('idNCC')
                ->references('maNCC')
                ->on('provide')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('tensp');
            $table->longText('mota');
            $table->unsignedInteger('soluongkho');
            $table->string('buyprice');
            $table->string('oldprice');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sanpham');
    }
};
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
        Schema::table('sanpham', function (Blueprint $table) {
            $table->unsignedInteger('soluongkho')->default(0)->change(); // Dòng này có thể bị lặp, nếu bị xóa dòng này đi nếu bạn đã thêm ở trên
            $table->raw('CHECK (soluongkho >= 0)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
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
    Schema::table('maysd', function (Blueprint $table) {
        // Xóa cột m_product_id và khóa ngoại tương ứng
        $table->dropForeign(['m_product_id']);
        $table->dropColumn('m_product_id');

        // Thêm cột mới m_cate_id và khóa ngoại tương ứng
        $table->unsignedBigInteger('m_cate_id')->unsigned();
        $table->foreign('m_cate_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
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

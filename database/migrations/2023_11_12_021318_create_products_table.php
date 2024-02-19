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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('p_name', 255);
            $table->string('p_code',20);
            $table->unsignedBigInteger('p_user_id');
            $table->foreign('p_user_id')
                ->references('id')
                ->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('p_category_id');
            $table->foreign('p_category_id')
                ->references('id')
                ->on('categories')->onDelete('cascade');
            $table->string('p_image',255);
            $table->double('p_price',10,2);
            $table->integer('p_total_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

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
        Schema::create('roomdetail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rd_product_id')->unsigned();
            $table->foreign('rd_product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('rd_quantity');
            $table->decimal('rd_total',16,2);
            $table->integer('rd_Percentage');
            $table->binary('rd_state');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roomdetail');
    }
};

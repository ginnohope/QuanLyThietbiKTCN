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
        Schema::create('maysd', function (Blueprint $table) {
            $table->id();
            $table->string('m_code', 20);
            $table->string('m_name', 255);
            $table->unsignedBigInteger('m_room_id')->unsigned();
            $table->foreign('m_room_id')->references('id')->on('rooms')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('m_product_id')->unsigned();
            $table->foreign('m_product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->dateTime('m_usedate');
            $table->text('m_notes');
            $table->binary('m_active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maysd');
    }
};

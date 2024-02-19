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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('r_name', 255);
            $table->unsignedBigInteger('r_floor_id')->unsigned();
            $table->foreign('r_floor_id')->references('id')->on('floors')->onUpdate('cascade')->onDelete('cascade');
            $table->binary('r_active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};

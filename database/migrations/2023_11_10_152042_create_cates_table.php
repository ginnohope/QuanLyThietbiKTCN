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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('c_parent_id')->nullable();
            $table->foreign('c_parent_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
            $table->unsignedBigInteger('c_supplier_id')->nullable();
            $table->foreign('c_supplier_id')
                 ->references('id')
                ->on('suppliers')
                ->onDelete('cascade');
            $table->string('c_name', 255);
            $table->string('c_code', 20);
            $table->binary('avtive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

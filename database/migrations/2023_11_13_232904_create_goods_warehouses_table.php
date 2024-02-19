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
        Schema::create('goods_warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('gw_code', 20);
            $table->string('gw_name',255);
            $table->string('gw_reason',255)->nullable();
            $table->decimal('gw_total',10,2);
            $table->unsignedBigInteger('gw_user_id');
            $table->foreign('gw_user_id')
                ->references('id')
                ->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('wg_supplier_id');
            $table->foreign('wg_supplier_id')
                ->references('id')
                ->on('suppliers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods_warehouses');
    }
};

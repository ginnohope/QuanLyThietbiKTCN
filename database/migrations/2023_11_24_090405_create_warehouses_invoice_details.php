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
        Schema::create('warehouses_invoice_details', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('wid_quantity');
			$table->decimal('wid_total',10,2);
			$table->unsignedBigInteger('wid_goodwarehouse_id')->unsigned();
            $table->foreign('wid_goodwarehouse_id')->references('id')->on('goods_warehouses')->onUpdate('cascade');
            $table->unsignedBigInteger('wid_product_id')->unsigned();
            $table->foreign('wid_product_id')->references('id')->on('products')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouses_invoice_details');
    }
};

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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('s_name', 255);
            $table->string('s_code', 15);
            $table->string('s_email',100);
            $table->string('s_phone', 15);
            $table->string('s_tax', 20);
            $table->string('s_address',255);
            $table->string('s_logo',255);
            $table->string('s_acc_number',255);
            $table->string('s_name_bank',255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};

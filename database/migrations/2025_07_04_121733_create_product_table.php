<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('productTitle');
            $table->unsignedBigInteger('productCategoryId')->nullable();
            $table->string('productBarcode');
            $table->string('productStatus');
            $table->timestamps();

            $table->foreign('productCategoryId')->references('id')->on('category')->onDelete('set null');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};

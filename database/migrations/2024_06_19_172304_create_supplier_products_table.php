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
        Schema::create('supplier_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('image');
            $table->longText('description');
            $table->integer('category_id');
            $table->integer('user_id');
            $table->string('price');
            $table->integer('brand_id')->nullable();
            $table->integer('active')->default(0);
            $table->integer('count')->default(0);
            $table->integer('instock')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_products');
    }
};

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
        Schema::create('user_interfaces', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_address')->nullable();
            $table->longText('description')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('cover_image')->nullable();
            $table->longText('about_us_description')->nullable();
            $table->json('about_us_image')->nullable();
            $table->longText('footer_description')->nullable();
            $table->longText('supplier_policy')->nullable();
            $table->string('font_color')->nullable();
            $table->string('bg_color')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_interfaces');
    }
};

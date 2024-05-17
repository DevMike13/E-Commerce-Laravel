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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_category_id')->constrained('sub_categories');
            $table->string("name");
            $table->string('slug')->unique();
            $table->json('images')->nullable();
            $table->string("description")->nullable();
            $table->string("price");
            $table->string("specs");
            $table->boolean('is_active')->default(true);
            $table->boolean('is_selected')->default(false);
            $table->boolean('is_promotion')->default(false);
            $table->boolean('is_preorder')->default(false);
            $table->boolean('in_stock')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

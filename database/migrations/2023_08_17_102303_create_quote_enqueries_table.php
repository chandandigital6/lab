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
        Schema::create('quote_enqueries', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('ProductCategory_id')->nullable()->change();
            $table->foreignId('ProductCategory_id')->references('id')->on('product_categories');
            $table->string('requirement');
//            $table->string('category');
            $table->string('quantity');
            $table->string('msg');
            $table->enum('status',['accept','reject'])->default('accept');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_enqueries');
    }
};

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
        Schema::create('venders', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('contact_person_name');
            $table->string('email_id');
            $table->bigInteger('phone_no');
            $table->string('product_categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venders');
    }
};

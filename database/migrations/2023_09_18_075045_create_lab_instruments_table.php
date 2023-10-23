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
        Schema::create('lab_instruments', function (Blueprint $table) {
            $table->id();
            $table->string('instrument_name');
            $table->date('date_of_purchase');
            $table->string('supplier_company_name');
            $table->date('warranty_period');
            $table->string('company_name');
            $table->string('engineer_name');
            $table->string('email_id');
            $table->string('phone_no');  // Change to string or bigInteger based on your needs
            $table->string('company_contact_no');  // Change to string or bigInteger based on your needs
            $table->string('po_invoice_no');
            $table->string('instrument_photo')->nullable();  // Change to 'instrument_photo' to match Laravel naming conventions
            $table->string('bought_from_research_project_fund_name');
            $table->string('calibration_detail');
            $table->string('calibration_detail_image')->nullable();
            $table->string('instrument_training_manual_protocol')->nullable();
            $table->string('instrument_training_manual_protocol_image')->nullable();
            $table->string('instrument_working_status');
            $table->date('instrument_periodical_service_date');  // Change to 'date' for date columns
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lab_instruments');
    }
};

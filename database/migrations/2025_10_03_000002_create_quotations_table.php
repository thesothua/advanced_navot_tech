<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained()->nullOnDelete();
            $table->string('quotation_no')->unique();
            $table->date('quotation_date');
            $table->string('currency')->default('INR');
            // snapshot customer details on the quotation
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_gst_no')->nullable();
            $table->string('customer_street')->nullable();
            $table->string('customer_city')->nullable();
            $table->string('customer_state')->nullable();
            $table->string('customer_zip')->nullable();
            $table->string('customer_country')->nullable();
            $table->json('selected_terms_and_conditions')->nullable();
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('total_gst', 12, 2)->default(0);
            $table->decimal('total_discount', 12, 2)->default(0);
            $table->decimal('grand_total', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};

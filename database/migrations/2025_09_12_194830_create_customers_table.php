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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('email')->nullable();
            $table->string('gst_no')->nullable();
            $table->string('phone')->nullable();
            $table->string('status')->default('ACTIVE'); // active, inactive, etc.
            $table->string('company_name')->nullable();
            $table->json('address')->nullable();
            $table->text('description')->nullable();
            $table->string('contact_source')->nullable(); // website, referral, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Drop the existing foreign key constraint
            $table->dropForeign(['brand_id']);
            
            // Modify the column to be nullable
            $table->foreignId('brand_id')->nullable()->change();
            
            // Re-add the foreign key constraint with SET NULL on delete
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Drop the nullable foreign key constraint
            $table->dropForeign(['brand_id']);
            
            // Modify the column to be not nullable
            $table->foreignId('brand_id')->nullable(false)->change();
            
            // Re-add the foreign key constraint with CASCADE on delete
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
        });
    }
};
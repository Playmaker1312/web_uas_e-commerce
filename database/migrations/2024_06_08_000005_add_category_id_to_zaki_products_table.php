<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('zaki_products', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->constrained('zaki_categories')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('zaki_products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
}; 
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('zaki_orders', function (Blueprint $table) {
            $table->string('status')->default('pending')->after('shipping_address');
        });
    }

    public function down(): void
    {
        Schema::table('zaki_orders', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}; 
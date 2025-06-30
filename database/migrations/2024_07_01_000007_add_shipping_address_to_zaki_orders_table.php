<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('zaki_orders', function (Blueprint $table) {
            $table->string('shipping_address')->nullable()->after('total');
        });
    }

    public function down(): void
    {
        Schema::table('zaki_orders', function (Blueprint $table) {
            $table->dropColumn('shipping_address');
        });
    }
}; 
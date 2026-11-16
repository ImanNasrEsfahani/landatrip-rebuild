<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('invoice_details', function (Blueprint $table) {
            // Historical invoices cannot be assigned a group reliably.
            $table->string('group_id', 26)->nullable()->after('tour_id')->index();
            $table->foreign('group_id')->references('id')->on('groups');
        });
    }

    public function down(): void
    {
        Schema::table('invoice_details', function (Blueprint $table) {
            $table->dropForeign(['group_id']);
            $table->dropColumn('group_id');
        });
    }
};

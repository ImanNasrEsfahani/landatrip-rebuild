<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('temporary_files', function (Blueprint $table) {
            $table->ulid('owner_id')->nullable()->index();
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('consumed_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('temporary_files', function (Blueprint $table) {
            $table->dropColumn(['owner_id', 'expires_at', 'consumed_at']);
        });
    }
};

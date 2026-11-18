<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tours', fn (Blueprint $table) => $table->ulid('certification_id')->nullable()->change());
    }

    public function down(): void
    {
        if (DB::table('tours')->whereNull('certification_id')->exists()) {
            throw new RuntimeException('Cannot restore a required certificate reference while tours without a template exist. Preserve and reconcile them first.');
        }
        Schema::table('tours', fn (Blueprint $table) => $table->ulid('certification_id')->nullable(false)->change());
    }
};

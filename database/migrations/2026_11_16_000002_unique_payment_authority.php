<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        $duplicate = DB::table('transactions')->select('authority')
            ->whereNotNull('authority')->groupBy('authority')
            ->havingRaw('COUNT(*) > 1')->first();
        if ($duplicate) {
            throw new RuntimeException('Duplicate payment authorities must be reconciled before adding the unique index.');
        }
        Schema::table('transactions', fn (Blueprint $table) => $table->unique('authority'));
    }

    public function down(): void
    {
        Schema::table('transactions', fn (Blueprint $table) => $table->dropUnique(['authority']));
    }
};

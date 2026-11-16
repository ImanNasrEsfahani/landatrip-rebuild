<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('group_price_items', function (Blueprint $table) {
            // Historical DOUBLE values can have more than two places or exceed this range.
            $table->decimal('amount_exact', 12, 2)->nullable();
            $table->string('pricing_version')->nullable();
            $table->string('pricing_role')->nullable();
            $table->string('participant_category')->nullable();
        });
        Schema::table('invoices', function (Blueprint $table) {
            foreach (['subtotal', 'discount', 'tax', 'total'] as $field) {
                $table->decimal($field.'_exact', 12, 2)->nullable();
            }
            $table->string('pricing_version')->nullable();
            $table->json('pricing_snapshot')->nullable();
            $table->timestamp('hold_expires_at')->nullable();
            $table->string('checkout_key')->nullable()->unique();
            $table->string('checkout_fingerprint')->nullable();
            $table->string('test_checkout_token_hash', 64)->nullable();
        });
        Schema::table('invoice_details', function (Blueprint $table) {
            $table->foreignId('group_price_item_id')->nullable()->constrained('group_price_items');
            $table->string('title_snapshot')->nullable();
            $table->string('participant_category')->nullable();
            $table->foreignId('currency_id')->nullable()->constrained('currencies');
            $table->decimal('unit_amount', 12, 2)->nullable();
            $table->decimal('line_total', 12, 2)->nullable();
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('provider')->nullable();
            $table->unsignedBigInteger('gateway_minor_units')->nullable();
        });
        Schema::create('booking_holds', function (Blueprint $table) {
            $table->id();
            // Legacy invoices.id has no unique index. Keep its contents untouched.
            $table->foreignUlid('invoice_id')->unique();
            $table->foreignUlid('group_id')->constrained('groups');
            $table->unsignedInteger('quantity');
            $table->string('status');
            $table->timestamp('expires_at');
            $table->timestamps();
            $table->index(['group_id', 'status', 'expires_at']);
        });
        Schema::create('test_checkout_fixture_markers', function (Blueprint $table) {
            $table->id();
            $table->string('token_hash', 64)->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        if (DB::table('booking_holds')->exists() || DB::table('invoices')->whereNotNull('pricing_version')->exists()) {
            throw new RuntimeException('Cannot roll back while versioned checkout invoices or holds exist.');
        }
        Schema::dropIfExists('test_checkout_fixture_markers');
        Schema::dropIfExists('booking_holds');
        Schema::table('transactions', fn (Blueprint $table) => $table->dropColumn(['provider', 'gateway_minor_units']));
        Schema::table('invoice_details', function (Blueprint $table) {
            $table->dropConstrainedForeignId('group_price_item_id');
            $table->dropConstrainedForeignId('currency_id');
            $table->dropColumn(['title_snapshot', 'participant_category', 'unit_amount', 'line_total']);
        });
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn(['pricing_version', 'pricing_snapshot', 'hold_expires_at', 'checkout_key', 'checkout_fingerprint', 'test_checkout_token_hash']);
            foreach (['subtotal', 'discount', 'tax', 'total'] as $field) {
                $table->dropColumn($field.'_exact');
            }
        });
        Schema::table('group_price_items', function (Blueprint $table) {
            $table->dropColumn(['amount_exact', 'pricing_version', 'pricing_role', 'participant_category']);
        });
    }
};

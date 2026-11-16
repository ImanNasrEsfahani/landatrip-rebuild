<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('group_price_items', function (Blueprint $table) {
            $table->decimal('amount', 12, 2)->change();
            $table->string('pricing_version')->nullable();
            $table->string('pricing_role')->nullable();
            $table->string('participant_category')->nullable();
        });
        Schema::table('invoices', function (Blueprint $table) {
            foreach (['subtotal', 'discount', 'tax', 'total'] as $field) {
                $table->decimal($field, 12, 2)->change();
            }
            $table->string('pricing_version')->nullable();
            $table->json('pricing_snapshot')->nullable();
            $table->timestamp('hold_expires_at')->nullable();
            $table->string('checkout_key')->nullable()->unique();
            $table->string('checkout_fingerprint')->nullable();
        });
        Schema::table('invoice_details', function (Blueprint $table) {
            $table->decimal('price', 12, 2)->change();
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
            $table->foreignUlid('invoice_id')->unique()->constrained('invoices');
            $table->foreignUlid('group_id')->constrained('groups');
            $table->unsignedInteger('quantity');
            $table->string('status');
            $table->timestamp('expires_at');
            $table->timestamps();
            $table->index(['group_id', 'status', 'expires_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_holds');
        Schema::table('transactions', fn (Blueprint $table) => $table->dropColumn(['provider', 'gateway_minor_units']));
        Schema::table('invoice_details', function (Blueprint $table) {
            $table->dropConstrainedForeignId('group_price_item_id');
            $table->dropConstrainedForeignId('currency_id');
            $table->dropColumn(['title_snapshot', 'participant_category', 'unit_amount', 'line_total']);
            $table->double('price')->change();
        });
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn(['pricing_version', 'pricing_snapshot', 'hold_expires_at', 'checkout_key', 'checkout_fingerprint']);
            foreach (['subtotal', 'discount', 'tax', 'total'] as $field) {
                $table->double($field)->change();
            }
        });
        Schema::table('group_price_items', function (Blueprint $table) {
            $table->dropColumn(['pricing_version', 'pricing_role', 'participant_category']);
            $table->double('amount')->change();
        });
    }
};

<?php

use App\Enums\InvoiceStatusEnum;
use App\Models\Coupon;
use App\Models\Currency;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->ulid('id');
            $table->string("title");
            $table->string('user_id', 26);
//            $table->foreignUlid(User::class);
            $table->foreignIdFor(Coupon::class)->nullable();
            $table->foreignIdFor(Currency::class)->nullable();
            $table->double('total');
            $table->double('discount');
            $table->double('tax');
            $table->double('subtotal');
            $table->date("expire");
            $table->integer("status")->default(InvoiceStatusEnum::pending);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};

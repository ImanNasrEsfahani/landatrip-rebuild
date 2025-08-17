<?php

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
        Schema::create('group_price_items', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->foreignIdFor(\App\Models\Group::class);
            $table->foreignIdFor(\App\Models\Currency::class);
            $table->double("amount");
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
        Schema::dropIfExists('group_price_items');
    }
};

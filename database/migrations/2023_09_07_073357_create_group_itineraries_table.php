<?php

use App\Models\Group;
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
        Schema::create('group_itineraries', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Group::class);
            $table->boolean("breakfast")->default(false);
            $table->boolean("lunch")->default(false);
            $table->boolean("snack")->default(false);
            $table->boolean("dinner")->default(false);
            $table->string("from")->nullable();
            $table->string("to")->nullable();
            $table->string("by")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_itineraries');
    }
};

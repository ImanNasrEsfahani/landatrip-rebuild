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
        Schema::create('start_points', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Group::class);
            $table->integer("starting_location");
            $table->integer("ending_location");
            $table->string("transport");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('start_points');
    }
};

<?php

use App\Models\Badge;
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
        Schema::create('badge_levels', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Badge::class);
            $table->string("name");
            $table->string("image");
            $table->float("criterion_min")->nullable();
            $table->bigInteger("criterion_max")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('badge_levels');
    }
};

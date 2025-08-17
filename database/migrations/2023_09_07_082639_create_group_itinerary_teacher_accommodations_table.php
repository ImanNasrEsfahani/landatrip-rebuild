<?php

use App\Models\GroupItinerary;
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
        Schema::create('group_itinerary_teacher_accommodations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(GroupItinerary::class);
            $table->integer("hotel_grade");
            $table->integer("city");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_itinerary_teacher_accommodations');
    }
};

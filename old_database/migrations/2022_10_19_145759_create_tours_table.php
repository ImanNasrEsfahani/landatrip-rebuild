<?php

use App\Enums\TourEvaluationEnum;
use App\Enums\TourStatusEnums;
use App\Models\Certification;
use App\Models\City;
use App\Models\Highlight;
use App\Models\Itinerary;
use App\Models\Language;
use App\Models\Location;
use App\Models\TourExclude;
use App\Models\TourInclude;
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
        Schema::create('tours', function (Blueprint $table) {
            $table->ulid("id");
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Certification::class);
            $table->string("teacher_name");
//            $table->string("header_pic");
//            $table->string("thumbnail_pic");
//            $table->string("brochure_pic");
            $table->foreignIdFor(Language::class);
            $table->string("title");
            $table->string("subtitle")->nullable();
            $table->mediumText("slug")->nullable();
            $table->mediumText("short_summary");
            $table->foreignIdFor(City::class);
//            $table->string("group_size");
//            $table->string("accommodation");
//            $table->string("meals");
//            $table->string("transport");
            $table->integer("days")->default(0);
            $table->integer("nights")->default(0);
            $table->integer("min_age")->default(0);
            $table->integer("max_age")->default(0);
            //$table->float("price");
            $table->longText("skills")->nullable();
            $table->string("transport")->nullable();
            $table->string("evaluation_type")->nullable();
            $table->string("min_score")->nullable();
            $table->longText("tour_overview");
//            $table->foreignIdFor(TourInclude::class);
//            $table->foreignIdFor(TourExclude::class);
//            $table->string("gallery");
            $table->string("map")->nullable();
//            $table->string("certificates");
//            $table->string("terms-and-conditions");
//            $table->string("dates");
//            $table->mediumText("comments");
            $table->string("tour_brochure")->nullable();
            $table->integer("status")->default(TourStatusEnums::pending);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tours');
    }
};

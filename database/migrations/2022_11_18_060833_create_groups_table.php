<?php

use App\Enums\GroupStatusEnum;
use App\Enums\TourEvaluationEnum;
use App\Models\Currency;
use App\Models\GroupPriceItem;
use App\Models\GroupRequirement;
use App\Models\Language;
use App\Models\Tour;
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
    public function up(): void
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->ulid("id")->primary()->autoIncrement();
            $table->foreignIdFor(Language::class);
            $table->foreignIdFor(Tour::class);
//            $table->foreignIdFor(Currency::class);
            $table->string("title");
            $table->mediumText("slug");
            $table->boolean("public")->default(true);
            $table->date("start_registration_date");
            $table->date("end_registration_date");
            $table->date("start_date_tour");
            $table->date("end_date_tour");
//            $table->string("accommodation");
            $table->unsignedTinyInteger("days");
            $table->unsignedTinyInteger("nights");
            $table->unsignedBigInteger("min_capacity");
            $table->unsignedBigInteger("max_capacity");
            $table->integer("score")->nullable();
            $table->integer("evaluation")->default(TourEvaluationEnum::noEvaluation);
//            $table->float("price")->default(0);
            $table->integer("status")->default(GroupStatusEnum::registration);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};

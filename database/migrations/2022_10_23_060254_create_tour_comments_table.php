<?php

use App\Models\Language;
use App\Models\Tour;
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
        Schema::create('tour_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Language::class);
            $table->foreignIdFor(Tour::class);
            $table->foreignIdFor(User::class);
            $table->unsignedInteger("star");
            $table->mediumText("comment");
            $table->dateTime("verify_at")->nullable();
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
        Schema::dropIfExists('tour_comments');
    }
};

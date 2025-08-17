<?php

use App\Models\Language;
use App\Models\TourComment;
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
        Schema::create('tour_comment_replies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TourComment::class);
            $table->foreignIdFor(User::class);
            $table->mediumText("reply");
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
        Schema::dropIfExists('tour_comment_replies');
    }
};

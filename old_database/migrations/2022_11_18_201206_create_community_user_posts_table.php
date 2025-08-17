<?php

use App\Models\Community;
use App\Models\CommunityUser;
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
        Schema::create('community_user_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Community::class);
            $table->foreignIdFor(User::class);
            $table->string('location');
            $table->string('title');
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
        Schema::dropIfExists('community_user_posts');
    }
};

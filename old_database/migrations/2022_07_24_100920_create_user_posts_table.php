<?php

use App\Models\Group;
use App\Models\User;
use App\Models\UserPost;
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
        Schema::create('user_posts', function (Blueprint $table) {
            $table->ulid("id")->primary()->autoIncrement();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Group::class)->nullable();
            $table->string("location");
            $table->boolean("is_drafted")->default(false);
            $table->boolean("is_approved")->default(true);
            $table->string("title")->nullable();
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
        Schema::dropIfExists('user_posts');
    }
};

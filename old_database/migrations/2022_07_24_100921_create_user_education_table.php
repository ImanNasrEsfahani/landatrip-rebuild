<?php

use App\Enums\UserEducationStatusEnum;
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
        Schema::create('user_educations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string("title");
            $table->string("university");
            $table->string("level");
            $table->string("from");
            $table->string("to")->nullable();
            $table->integer("status")->default(UserEducationStatusEnum::student);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_education');
    }
};

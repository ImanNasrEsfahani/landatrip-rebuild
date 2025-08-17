<?php

use App\Enums\ProviderEnum;
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
    public function up()   {
        Schema::create('users', function (Blueprint $table) {
            $table->ulid("id")->primary()->autoIncrement();
            $table->string('fname');
            $table->string('lname');
            $table->string('slug')->unique();
            $table->string('title')->nullable();
            $table->string('birthday')->nullable();
//            $table->string("provider_token")->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string("phone_number")->nullable();
            $table->timestamp('phone_number_verified_at')->nullable();
            $table->string("verification_code")->nullable();
            $table->timestamp('verification_code_expire')->nullable();
            $table->string('password')->nullable();
            $table->string('location')->nullable();
            $table->unsignedInteger('sex')->default(0);
            $table->mediumText('about_me')->nullable();
            $table->longText('skills')->nullable();
            $table->integer("score")->default(0);
            $table->integer("provider")->default(ProviderEnum::landatrip);
            $table->boolean("suspended")->default(false);
            $table->string('remember_token', 280)->nullable();
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
        Schema::dropIfExists('users');
    }
};

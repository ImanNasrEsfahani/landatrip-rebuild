<?php

use App\Enums\PrivacyPolicyEnum;
use App\Models\PrivacyPolicy;
use App\Models\User;
use App\Models\UserPrivacy;
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
        Schema::create('user_privacy', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PrivacyPolicy::class);
            $table->foreignIdFor(User::class);
            $table->integer("status")->default(PrivacyPolicyEnum::Public);
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
        Schema::dropIfExists('user_privacies');
    }
};

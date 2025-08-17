<?php

use App\Enums\UserAgreementStatusEnum;
use App\Models\Agreement;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
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
        Schema::create('user_agreements', function (Blueprint $table) {
            $table->ulid("id")->primary()->autoIncrement();
            $table->foreignIdFor(Agreement::class);
            $table->foreignIdFor(User::class, "user_id");
            $table->foreignIdFor(User::class, "assigned_by")->nullable();
            $table->boolean("acceptance")->default(false);
            $table->integer("status")->default(UserAgreementStatusEnum::pending);
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
        Schema::dropIfExists('user_agreements');
    }
};

<?php

use App\Models\ArticleCategory;
use App\Models\Language;
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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(ArticleCategory::class);
            $table->foreignIdFor(Language::class);
            $table->string('title');
            $table->string('slug');
            $table->longText('body');
            $table->mediumText('keywords');
            $table->mediumText('description');
            $table->mediumText('short_text');
            $table->integer('reading_time');
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
        Schema::dropIfExists('article');
    }
};

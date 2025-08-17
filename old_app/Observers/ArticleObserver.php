<?php

namespace App\Observers;

use App\Enums\CouponStatusEnum;
use App\Models\Article;
use App\Models\Coupon;
use App\Services\SlugGeneratorService;
use App\Traits\Slugable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleObserver
{
    /**
     * Handle the Coupon "creating" event.
     *
     * @param Article $article
     * @return void
     */
    public function creating(Article $article)
    {
        $article->language_id = $article->articleCategory()->first()->language_id;
        $article->slug = $article::makeSlug($article->title);
    }

    /**
     * Handle the Contact "created" event.
     *
     * @param Article $article
     * @return void
     */
    public function created(Article $article)
    {
        //
    }

    /**
     * Handle the Contact "updated" event.
     *
     * @param Article $article
     * @return void
     */
    public function updated(Article $article)
    {
        //
    }

    /**
     * Handle the Contact "deleted" event.
     *
     * @param Article $article
     * @return void
     */
    public function deleted(Article $article)
    {
        //
    }

    /**
     * Handle the Contact "restored" event.
     *
     * @param Article $article
     * @return void
     */
    public function restored(Article $article)
    {
        //
    }

    /**
     * Handle the Contact "force deleted" event.
     *
     * @param Article $article
     * @return void
     */
    public function forceDeleted(Article $article)
    {
        //
    }
}

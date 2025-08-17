<?php

namespace App\Models;


use App\Events\CreateCommunityEvent;
use App\Traits\Slugable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @property numeric user_id
 * @property string  title
 * @property string  slug
 * @property string  about_us
 * @property boolean admin_only
 */

class Community extends BaseModel
{
    use HasFactory, Slugable, HasUlids;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'communities';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        "title",
        "slug",
        "about_us",
        "admin_only"
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @return void
     */
    protected static function boot():void
    {
        parent::boot();
        static::created(function ($model) {
            CreateCommunityEvent::dispatch($model);
        });
    }


    /**
     * Get the images for this community.
     */
    public function images(): MorphMany|Image|array
    {
        return $this->morphMany(Image::class, 'parentable');
    }

    /**
     * Get the header's Image of this community.
     */
    public function headerImage(): Image|MorphOne|null
    {
        return $this->morphOne(Image::class, 'parentable')->where('image_type','=','header',);
    }

    /**
     * Get the thumbnail's Image of this community.
     */
    public function thumbnailImage(): Image|MorphOne|null
    {
        return $this->morphOne(Image::class, 'parentable')->where('image_type','=','thumbnail',);
    }

    /**
     * Get the users' for this community
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'community_user');
    }


    public function communityUserPosts()
    {
        return $this->hasMany(CommunityUserPost::class)->orderByDesc('created_at');
    }

    public function communityUserPostLikes()
    {
        return $this->hasMany(CommunityUserPostLike::class);
    }


}

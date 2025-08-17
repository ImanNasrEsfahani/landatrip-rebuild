<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class CommunityUserPost extends BaseModel
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'community_user_posts';

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
        'community_id',
        'user_id',
        "location",
        "title",
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the community that owns this community's post.
     */
//    public function communityUser(): BelongsTo
//    {
//        return $this->belongsTo(CommunityUser::class);
//    }

    public function community(): BelongsTo
    {
        return $this->belongsTo(Community::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }



    /**
     * @return HasMany
     */
    public function communityUserPostComments(): HasMany
    {
        return $this->hasMany(CommunityUserPostComment::class);
    }

    /**
     * @return HasMany
     */
    public function communityUserPostLikes(): HasMany
    {
        return $this->hasMany(CommunityUserPostLike::class);
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
    public function contentImage(): Image|MorphOne|null
    {
        return $this->morphOne(Image::class, 'parentable')->where('image_type','=','content',);
    }
}

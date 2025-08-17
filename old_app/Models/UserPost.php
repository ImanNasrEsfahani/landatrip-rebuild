<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property string $user_id
 * @property string $title
 * @property string $location
 * @property mixed  $user
 * @property mixed  $is_drafted
 * @property mixed  is_approved
 */

class UserPost extends BaseModel
{
    use HasFactory, HasUlids;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_posts';

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
        'group_id',
        'title',
        'location',
        'is_drafted',
        'is_approved',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];


    /**
     * Get the images for this community.
     */
    public function images(): MorphMany|Image|array
    {
        return $this->morphMany(Image::class, 'parentable');
    }

    /**
     * Get the user that owns the post article
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function userPostLikes(): HasMany
    {
        return $this->hasMany(UserPostLike::class);
    }

    /**
     * @return HasMany
     */
    public function userPostComments(): HasMany
    {
        return $this->hasMany(UserPostComment::class);
    }

    /**
     * Get the language that owns this skill.
     */
    public function usersPostSaved(): HasMany
    {
        return $this->hasMany(UserPostSave::class);
    }

    /**
     * Get the language that owns this skill.
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(UserPost::class);
    }

    /**
     * Get the language that owns this skill.
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
}

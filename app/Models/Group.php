<?php

namespace App\Models;

use App\Enums\GroupStatusEnum;
use App\Events\CreateGroupEvent;
use App\Services\SlugGeneratorService;
use App\Traits\Slugable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Casts\Attribute;


/**
 * @property numeric tour_operation_id
 * @property string  title
 * @property string  slug
 * @property boolean public
 * @property integer min_capacity
 * @property integer max_capacity
 * @property GroupStatusEnum status
 */
class Group extends BaseModel
{
    use HasFactory, Slugable, HasUlids;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'groups';
    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'language_id',
        "tour_id",
        //        "currency_id",
        "title",
        "slug",
        "public",
        "days",
        "nights",
        "start_registration_date",
        "end_registration_date",
        "start_audition_date",
        "end_audition_date",
        "start_date_tour",
        "end_date_tour",
        "starting_location",
        "ending_location",
        "min_capacity",
        "max_capacity",
        "transport",
        "status"
    ];

    /**
     *
     * @return array
     */
    protected $casts = [
        "start_date_tour"       => "datetime",
        "end_date_tour"         => "datetime",
        "end_registration_date" => "datetime",
        'status'                => GroupStatusEnum::class
    ];

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
    protected static function boot(): void
    {
        parent::boot();
        static::created(function ($model) {
            CreateGroupEvent::dispatch($model);
        });
    }

    /**
     * Get the language that owns this tour's operation
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    /**
     * Get the tour that owns this tour's operation
     */
    public function tour(): BelongsTo
    {
        return $this->belongsTo(Tour::class);
    }

    /**
     * Get the tour that owns this tour's operation
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Get the images for this community.
     */
    public function images(): MorphMany|Image|array
    {
        return $this->morphMany(Image::class, 'parentable');
    }

    /**
     * Get the thumbnail's Image of this community.
     */
    public function thumbnailImage(): Image|MorphOne|null
    {
        return $this->morphOne(Image::class, 'parentable')->where('image_type', '=', 'thumbnail',);
    }

    /**
     * Get the users' for this group
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'group_users')->withPivot("status")->withTimestamps();
    }

    /**
     * Get the users' for this group
     */
    public function groupPosts(): HasMany
    {
        return $this->hasMany(GroupPost::class);
    }

    /**
     * @return HasMany
     */
    public function groupTutors(): HasMany
    {
        return $this->hasMany(GroupTutor::class);
    }

    /**
     * Get the User that owns this certification
     */
    public function userRating(): HasMany
    {
        return $this->hasMany(UserRating::class);
    }

    /**
     * Get the User that owns this certification
     */
    public function groupRequirements(): HasMany
    {
        return $this->hasMany(GroupRequirement::class);
    }

    /**
     * Get the User that owns this transportation
     */
    public function transportation(): HasMany
    {
        return $this->hasMany(Transportation::class);
    }


}

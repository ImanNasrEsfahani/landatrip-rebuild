<?php

namespace App\Models;

use App\Enums\TourStatusEnums;
use App\Events\CreateTourEvent;
use App\Traits\Slugable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @property string $title
 * @property string $slug
 * @property string $short_summary
 * @property string $language_id
 * @property string $location_id
 * @property string $group_size
 * @property string $accommodation
 * @property string $meals
 * @property string $transport
 * @property string $days
 * @property string $nights
 * @property string $price
 * @property string $skills
 * @property string $tour_overview
 * @property string $gallery
 * @property string $map
 * @property string $certificates
 * @property string $dates
 * @property string $tour_brochure
 * @property string $status
 * @method static whereBelongsTo($lang)
 */

class Tour extends BaseModel
{
    use HasFactory, slugable, HasUlids;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tours';

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
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
//        'header_pic',
//        'thumbnail_pic',
        'language_id',
        'title',
        'slug',
        'short_summary',
        'subtitle',
        'location_id',
//        'group_size',
//        'accommodation',
//        'meals',
//        'transport',
//        'days',
//        'nights',
        //'price',
        'skills',
        'transport',
        'evaluation_type',
        'min_score',
        'tour_overview',
//        'highlights',
//        'itinerary',
//        'includes',
//        'excludes',
//        'gallery',
        'map',
        'certificates',
//        'terms_and_conditions',
//        'dates',
//        'comments',
        'tour_brochure',
        'status'
    ];

    protected $guarded = ['id'];

    protected $casts = [
        "skills"    =>  "array",
        "status"    =>  TourStatusEnums::class
    ];
    /**
     * Pending tours from table
     * @param $query
     * @return mixed
     */
    public function scopePending($query): mixed
    {
        return $query->where('status', TourStatusEnums::pending);
    }

    /**
     * Approved tours from table
     * @param $query
     * @return mixed
     */
    public function scopeApproved($query): mixed
    {
        return $query->where('status', TourStatusEnums::approved);
    }

    public function scopePubliclyVisible($query)
    {
        return $query->approved()->whereHas('language', fn ($language) => $language->where('slug', app()->getLocale()));
    }

    /**
     * @return void
     */
    protected static function boot():void
    {
        parent::boot();
//        static::creating(function ($model) {
//            $model->slug = $model::makeSlug($model->title);
//        });
//        static::created(function ($model) {
//            CreateTourEvent::dispatch($model);
//        });
    }

    /**
     * Rejected tours from table
     * @param $query
     * @return mixed
     */
    public function scopeRejected($query): mixed
    {
        return $query->where('status', TourStatusEnums::rejected);
    }

    /**
     * Suspended tours from table
     * @param $query
     * @return mixed
     */
    public function scopeSuspended($query): mixed
    {
        return $query->where('status', TourStatusEnums::suspended);
    }

    /**
     * Get the highlights for this tour.
     */
    public function tourHighlights(): HasMany
    {
        return $this->hasMany(TourHighlight::class);
    }

    /**
     * Get the Itineraries for this tour.
     */
    public function tourItineraries(): HasMany
    {
        return $this->hasMany(TourItinerary::class);
    }

    /**
     * Get the Includes for this tour.
     */
    public function tourIncludes(): HasMany
    {
        return $this->hasMany(TourInclude::class);
    }

    /**
     * Get the Excludes for this tour.
     */
    public function tourExcludes(): HasMany
    {
        return $this->hasMany(TourExclude::class);
    }

    /**
     * Get the Terms and Conditions for this tour.
     */
    public function termAndCondition(): HasMany
    {
        return $this->hasMany(TermAndCondition::class);
    }

    /**
     * Get the gallery for this tour.
     */
    public function gallery(): HasMany
    {
        return $this->hasMany(TourGallery::class);
    }

    /**
     * Get the certificate for this tour.
     */
    public function certificate(): HasMany
    {
        return $this->hasMany(Certification::class);
    }


    /**
     * Get the images for this tour.
     */
    public function images(): MorphMany|Image|array
    {
        return $this->morphMany(Image::class, 'parentable');
    }

    /**
     * Get the header's Image of this tour.
     */
    public function headerImage(): Image|MorphOne|null
    {
        return $this->morphOne(Image::class, 'parentable')->where('image_type','=','header',);
    }

    /**
     * Get the thumbnail's Image of this tour.
     */
    public function thumbnailImage(): Image|MorphOne|null
    {
        return $this->morphOne(Image::class, 'parentable')->where('image_type','=','thumbnail',);
    }

    /**
     * Get the brochure's Image of this tour.
     */
    public function brochureImage(): Image|MorphOne|null
    {
        return $this->morphOne(Image::class, 'parentable')->where('image_type','=','brochure',);
    }

    /**
     * Get the Language that owns the tour.
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    /**
     * Get the location that owns the tour.
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get the location that owns the tour.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Get the groups for this tour. --**
     */
    public function tourComments(): HasMany
    {
        return $this->hasMany(TourComment::class);
    }

    /**
     * Get the groups for this tour. --**
     */
    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

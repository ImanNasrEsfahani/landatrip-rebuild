<?php

namespace App\Models;
use App\Traits\Slugable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @property numeric $language_id
 * @property string  $title
 * @property string  $slug
 */

class Skill extends BaseModel
{
    use HasFactory, Slugable;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'skills';

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
        'language_id',
        'title',
        'slug'
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Get the language that owns this skill.
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    /**
     * Get the images for this skill.
     */
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'parentable');
    }

    /**
     * Get the thumbnail most recent image for this skill.
     */
    public function thumbnailImage(): MorphOne|null
    {
        return $this->morphOne(Image::class, 'parentable')->where('image_type','=','thumbnail',);
    }
}

<?php

namespace App\Models;

use App\Traits\Slugable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Region extends Model
{
    use HasFactory, Slugable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'regions';

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
        'name',
        'code',
        'phone',
        'slug'
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the language that owns the highlight.
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
    /**
     * Get the language that owns the highlight.
     */
    public function countries(): HasMany
    {
        return $this->hasMany(Country::class);
    }
    /**
     * Get the language that owns the highlight.
     */
    public function cities(): HasManyThrough
    {
        return $this->hasManyThrough(City::class, Country::class);
    }
}

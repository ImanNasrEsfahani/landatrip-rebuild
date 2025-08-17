<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserRating extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_ratings';

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
        'user_rated_id',
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the User that owns this certification
     */
    public function userRating(): BelongsTo
    {
        return $this->belongsTo(User::class,"user_id");
    }

    /**
     * Get the User that owns this certification
     */
    public function userRated(): BelongsTo
    {
        return $this->belongsTo(User::class,"user_rated_id");
    }

    /**
     * Get the User that owns this certification
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

}

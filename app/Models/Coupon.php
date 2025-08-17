<?php

namespace App\Models;

use App\Enums\CouponStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property mixed $code
 * @property mixed $description
 * @property mixed $expire
 * @property mixed $status
 */
class Coupon extends BaseModel
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'coupons';

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
        "code",
        "description",
        "expire",
        "status",
        "percent",
        "maximum_discount"
    ];

    /**
     *
     * @return array
     */
    protected $casts = [
        'status'   => CouponStatusEnum::class,
        'expire'   => "datetime"
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected     $guarded = ['id'];

    /**
     * Get the language that owns this skill.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_coupons')->withTimestamps();
    }
}

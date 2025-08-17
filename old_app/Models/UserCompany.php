<?php

namespace App\Models;

use App\Enums\UserCompanyStatusEnum;
use App\Enums\UserDocumentStatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property numeric $user_id
 * @property numeric $company_name
 * @property numeric $position
 * @property numeric $from
 * @property numeric $to
 */

class UserCompany extends BaseModel
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_companies';

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
        "company_name",
        "position",
        "from",
        "to",
        "status"
    ];

    /**
     *
     * @return array
     */
    protected $casts = [
        'status' => UserCompanyStatusEnum::class
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

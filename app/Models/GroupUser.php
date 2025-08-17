<?php

namespace App\Models;

use App\Enums\GroupStatusEnum;
use App\Enums\GroupUserStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GroupUser extends BaseModel
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'group_users';

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
        "group_id",
        "user_id",
        "status",
    ];

    /**
     *
     * @return array
     */
    protected $casts = [
        'status' => GroupUserStatusEnum::class
    ];

    /**
     * Get the groups of the user
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class);
    }

    /**
     * Get the users of this group
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}

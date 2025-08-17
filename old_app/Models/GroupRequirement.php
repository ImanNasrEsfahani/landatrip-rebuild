<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class GroupRequirement extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'group_requirements';

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
        "group_requirement_type_id",
        "title"
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected     $guarded = ['id'];

    /**
     * @return BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }
    /**
     * @return BelongsTo
     */
    public function groupRequirementsType(): BelongsTo
    {
        return $this->belongsTo(GroupRequirementType::class);
    }

    /**
     * Get the language that owns this skill.
     */
    public function Users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'group_requirement_users');
    }
}

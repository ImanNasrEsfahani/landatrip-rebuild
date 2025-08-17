<?php

namespace App\Models;

use App\Enums\InvoiceStatusEnum;
use App\Enums\PermissionLevelEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserViewPermission extends BaseModel
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_view_permissions';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "user_id",
        "user_view_id",
        "permission_level"
    ];

    /**
     *
     * @return array
     */
    protected $casts = [
        'permission_level'   => PermissionLevelEnum::class
    ];

    /**
     * @return void
     */
    public function user()
    {
        $this->belongsTo(User::class);
    }

    /**
     * @return void
     */
    public function userView()
    {
        $this->belongsTo(UserView::class);
    }
}

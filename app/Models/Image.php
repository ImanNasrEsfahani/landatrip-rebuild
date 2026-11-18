<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $url
 * @property string $image_type
 * @property string $alt
 */

class Image extends BaseModel
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'images';

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
        'url', 'private_attachment',
        'image_type',
        'file_type',
        'alt',
        'parentable_id',
        'parentable_type'
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
    protected $hidden = ['private_attachment'];

    public function getUrlAttribute($value)
    {
        return $this->private_attachment
            ? route('api.public.ticket-attachments.download', ['image' => $this->id], false)
            : $value;
    }
}

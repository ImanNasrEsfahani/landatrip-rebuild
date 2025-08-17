<?php

namespace App\Models;

use App\Enums\InvoiceStatusEnum;
use App\Enums\TicketPriorityStatusEnum;
use App\Enums\TicketStatusEnum;
use App\Events\InvoiceEvent;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property numeric $user_id
 * @property numeric $coupon_id
 * @property numeric $total
 * @property numeric $discount
 * @property numeric $tax
 * @property numeric $subtotal
 * @property BelongsTo  user
 */

class Invoice extends BaseModel
{
    use HasFactory, HasUlids;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'invoices';

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
        'id',
        'title',
        'user_id',
        'coupon_id',
        'currency_id',
        'total',
        'discount',
        'tax',
        'subtotal',
        'expire',
        'status'
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     *
     * @return array
     */
    protected $casts = [
        'expire'   => "date",
        'status'   => InvoiceStatusEnum::class
    ];

//    protected $dispatchesEvents = [
////        'created'   =>  InvoiceEvent::class
//        'created'   =>  function () {
//            InvoiceEvent::class
//        }
//}
//    ];

    protected static function boot()
    {
        parent::boot();
        User::creating(function ($model) {
            InvoiceEvent::dispatch();
            info("salam");
        });
    }

    /**
     * Get the user that owns this invoice
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the coupon that owns this invoice
     */
    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    /**
     * Get the currency that owns this invoice
     */
    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}

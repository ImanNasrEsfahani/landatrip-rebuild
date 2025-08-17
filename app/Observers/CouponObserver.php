<?php

namespace App\Observers;

use App\Enums\CouponStatusEnum;
use App\Models\Coupon;

class CouponObserver
{
    /**
     * Handle the Coupon "creating" event.
     *
     * @param Coupon $coupon
     * @return void
     */
    public function creating(Coupon $coupon)
    {
        if($coupon->expire->isPast()) $coupon->status = CouponStatusEnum::expired;
    }

    /**
     * Handle the Coupon "created" event.
     *
     * @param Coupon $coupon
     * @return void
     */
    public function created(Coupon $coupon)
    {
        //
    }

    /**
     * Handle the Coupon "updated" event.
     *
     * @param Coupon $coupon
     * @return void
     */
    public function updated(Coupon $coupon)
    {
        //
    }

    /**
     * Handle the Coupon "deleted" event.
     *
     * @param Coupon $coupon
     * @return void
     */
    public function deleted(Coupon $coupon)
    {
        //
    }

    /**
     * Handle the Coupon "restored" event.
     *
     * @param Coupon $coupon
     * @return void
     */
    public function restored(Coupon $coupon)
    {
        //
    }

    /**
     * Handle the Coupon "force deleted" event.
     *
     * @param Coupon $coupon
     * @return void
     */
    public function forceDeleted(Coupon $coupon)
    {
        //
    }
}

<?php

namespace App\Observers;

use App\Enums\CouponStatusEnum;
use App\Models\Coupon;
use App\Models\GroupUser;
use App\Models\User;
use App\Models\UserBadgeLevel;
use App\Services\EvaluationUserBadges;

class GroupUserObserver
{
    /**
     * Handle the Coupon "creating" event.
     *
     * @param GroupUser $groupUser
     * @return void
     */
    public function creating(GroupUser $groupUser)
    {
        //
    }

    /**
     * Handle the Coupon "created" event.
     *
     * @param GroupUser $groupUser
     * @return void
     */
    public function created(GroupUser $groupUser)
    {
        $evaluationUserBadgeObj = new EvaluationUserBadges(User::find($groupUser->user_id));

        $userBadgeLevelObj = new UserBadgeLevel($evaluationUserBadgeObj->explorer());
        $userBadgeLevelObj->user_id = $groupUser->user_id;
        $userBadgeLevelObj->save();
    }

    /**
     * Handle the Coupon "updated" event.
     *
     * @param GroupUser $groupUser
     * @return void
     */
    public function updated(GroupUser $groupUser)
    {
        //
    }

    /**
     * Handle the Coupon "deleted" event.
     *
     * @param GroupUser $groupUser
     * @return void
     */
    public function deleted(GroupUser $groupUser)
    {
        //
    }

    /**
     * Handle the Coupon "restored" event.
     *
     * @param GroupUser $groupUser
     * @return void
     */
    public function restored(GroupUser $groupUser)
    {
        //
    }

    /**
     * Handle the Coupon "force deleted" event.
     *
     * @param GroupUser $groupUser
     * @return void
     */
    public function forceDeleted(GroupUser $groupUser)
    {
        //
    }
}

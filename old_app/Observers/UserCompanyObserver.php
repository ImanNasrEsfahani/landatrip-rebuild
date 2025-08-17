<?php

namespace App\Observers;

use App\Enums\UserCompanyStatusEnum;
use App\Models\UserCompany;
use App\Services\UserScoreEvaluator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class UserCompanyObserver
{
    /**
     * Handle the Product "creating" event.
     *
     * @param UserCompany $userCompany
     * @return void
     */
    public function creating(UserCompany $userCompany): void
    {
        if(empty(trim($userCompany->to)) || $userCompany->to > Carbon::now()->year) {
            $userCompany->status = UserCompanyStatusEnum::working;
            $userCompany->to = null;
        } else {
            $userCompany->status = UserCompanyStatusEnum::completed;
        }

        $userEvaluationUpdate = new UserScoreEvaluator($userCompany->user);
        $userEvaluationUpdate->updateScore();
    }

    /**
     * Handle the UserCompany "created" event.
     *
     * @param UserCompany $userCompany
     * @return void
     */
    public function created(UserCompany $userCompany)
    {
        //
    }

    /**
     * Handle the UserCompany "updating" event.
     *
     * @param UserCompany $userCompany
     * @return void
     */
    public function updating(UserCompany $userCompany): void
    {
        if(empty(trim($userCompany->to)) || $userCompany->to > Carbon::now()->year) {
            $userCompany->status = UserCompanyStatusEnum::working;
            $userCompany->to = null;
        } else {
            $userCompany->status = UserCompanyStatusEnum::completed;
        }

        $userEvaluationUpdate = new UserScoreEvaluator($userCompany->user);
        $userEvaluationUpdate->updateScore();
    }

    /**
     * Handle the UserCompany "updated" event.
     *
     * @param UserCompany $userCompany
     * @return void
     */
    public function updated(UserCompany $userCompany)
    {
        //
    }

    /**
     * Handle the UserCompany "deleted" event.
     *
     * @param UserCompany $userCompany
     * @return void
     */
    public function deleted(UserCompany $userCompany)
    {
        $userEvaluationUpdate = new UserScoreEvaluator($userCompany->user);
        $userEvaluationUpdate->updateScore();
    }

    /**
     * Handle the UserCompany "restored" event.
     *
     * @param UserCompany $userCompany
     * @return void
     */
    public function restored(UserCompany $userCompany)
    {
        //
    }

    /**
     * Handle the UserCompany "force deleted" event.
     *
     * @param UserCompany $userCompany
     * @return void
     */
    public function forceDeleted(UserCompany $userCompany)
    {
        //
    }
}

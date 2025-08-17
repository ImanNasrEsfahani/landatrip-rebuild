<?php

namespace App\Observers;

use App\Enums\UserAgreementStatusEnum;
use App\Models\UserAgreement;
use App\Services\UserScoreEvaluator;
use Illuminate\Support\Facades\Config;

class UserAgreementObserver
{
    /**
     * Handle the Product "creating" event.
     *
     * @param UserAgreement $userAgreement
     * @return void
     */
    public function creating(UserAgreement $userAgreement): void
    {
        if(empty(trim($userAgreement->status))) {
            $userAgreement->status = UserAgreementStatusEnum::pending;
        }

        $userEvaluationUpdate = new UserScoreEvaluator($userAgreement->user);
        $userEvaluationUpdate->updateScore();
    }

    /**
     * Handle the UserAgreement "created" event.
     *
     * @param UserAgreement $userAgreement
     * @return void
     */
    public function created(UserAgreement $userAgreement)
    {
        //
    }

    /**
     * Handle the UserCompany "updating" event.
     *
     * @param UserAgreement $userAgreement
     * @return void
     */
    public function updating(UserAgreement $userAgreement): void
    {

        if($userAgreement->acceptance) {
            $userAgreement->status = UserAgreementStatusEnum::confirmed;
        } else {
            $userAgreement->status = UserAgreementStatusEnum::pending;
        }

        $userEvaluationUpdate = new UserScoreEvaluator($userAgreement->user);
        $userEvaluationUpdate->updateScore();
    }

    /**
     * Handle the UserAgreement "updated" event.
     *
     * @param UserAgreement $userAgreement
     * @return void
     */
    public function updated(UserAgreement $userAgreement)
    {
        //
    }

    /**
     * Handle the UserAgreement "deleted" event.
     *
     * @param UserAgreement $userAgreement
     * @return void
     */
    public function deleted(UserAgreement $userAgreement)
    {
        $userEvaluationUpdate = new UserScoreEvaluator($userAgreement->user);
        $userEvaluationUpdate->updateScore();
    }

    /**
     * Handle the UserAgreement "restored" event.
     *
     * @param UserAgreement $userAgreement
     * @return void
     */
    public function restored(UserAgreement $userAgreement)
    {
        //
    }

    /**
     * Handle the UserAgreement "force deleted" event.
     *
     * @param UserAgreement $userAgreement
     * @return void
     */
    public function forceDeleted(UserAgreement $userAgreement)
    {
        //
    }
}

<?php

namespace App\Observers;

use App\Enums\UserEducationStatusEnum;
use App\Models\UserEducation;
use App\Services\UserScoreEvaluator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class UserEducationObserver
{
//    protected UserScoreEvaluator $userScoreEvaluator;
//
//    public function __construct(UserScoreEvaluator $userScoreEvaluator)
//    {
//        $this->userScoreEvaluator = $userScoreEvaluator;
//    }

    /**
     * Handle the UserEducation "creating" event.
     *
     * @param UserEducation $userEducation
     * @return void
     */
    public function creating(UserEducation $userEducation): void
    {
        if(empty(trim($userEducation->to)) || $userEducation->to > Carbon::now()->year) {
            $userEducation->status = UserEducationStatusEnum::student;
            $userEducation->to = null;
        } else {
            $userEducation->status = UserEducationStatusEnum::completed;
        }

        $userEvaluationUpdate = new UserScoreEvaluator($userEducation->user);
        $userEvaluationUpdate->updateScore();
    }

    /**
     * Handle the UserEducation "created" event.
     *
     * @param UserEducation $userEducation
     * @return void
     */
    public function created(UserEducation $userEducation)
    {
        //
    }

    /**
     * Handle the $userEducation "updating" event.
     *
     * @param UserEducation $userEducation
     * @return void
     */
    public function updating(UserEducation $userEducation): void
    {
        if(is_null($userEducation->to) || $userEducation->to > Carbon::now()->year) {
            $userEducation->status = UserEducationStatusEnum::student;
            $userEducation->to = null;
        } else {
            $userEducation->status = UserEducationStatusEnum::completed;
        }

        $userEvaluationUpdate = new UserScoreEvaluator($userEducation->user);
        $userEvaluationUpdate->updateScore();
    }

    /**
     * Handle the UserEducation "updated" event.
     *
     * @param UserEducation $userEducation
     * @return void
     */
    public function updated(UserEducation $userEducation)
    {
        //
    }

    /**
     * Handle the UserEducation "deleted" event.
     *
     * @param UserEducation $userEducation
     * @return void
     */
    public function deleted(UserEducation $userEducation)
    {
        $userEvaluationUpdate = new UserScoreEvaluator($userEducation->user);
        $userEvaluationUpdate->updateScore();
    }

    /**
     * Handle the UserEducation "restored" event.
     *
     * @param UserEducation $userEducation
     * @return void
     */
    public function restored(UserEducation $userEducation)
    {
        //
    }

    /**
     * Handle the UserEducation "force deleted" event.
     *
     * @param UserEducation $userEducation
     * @return void
     */
    public function forceDeleted(UserEducation $userEducation)
    {
        //
    }
}

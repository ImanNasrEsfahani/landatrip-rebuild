<?php

namespace App\Observers;

use App\Enums\UserCompanyStatusEnum;
use App\Enums\UserDocumentStatusEnum;
use App\Models\UserCompany;
use App\Models\UserDocument;
use App\Services\UserScoreEvaluator;
use Carbon\Carbon;

class UserDocumentObserver
{
    /**
     * Handle the Product "creating" event.
     *
     * @param UserDocument $userDocument
     * @return void
     */
    public function creating(UserDocument $userDocument): void
    {
        $userDocument->status = UserDocumentStatusEnum::pending;

        $userEvaluationUpdate = new UserScoreEvaluator($userDocument->user);
        $userEvaluationUpdate->updateScore();
    }

    /**
     * Handle the UserDocument "created" event.
     *
     * @param UserDocument $userDocument
     * @return void
     */
    public function created(UserDocument $userDocument)
    {
        //
    }

    /**
     * Handle the UserCompany "updating" event.
     *
     * @param UserDocument $userDocument
     * @return void
     */
    public function updating(UserDocument $userDocument): void
    {
        if(empty(trim($userCompany->status))) {
            $userDocument->status = UserDocumentStatusEnum::pending;
        }

        $userEvaluationUpdate = new UserScoreEvaluator($userDocument->user);
        $userEvaluationUpdate->updateScore();
    }

    /**
     * Handle the UserDocument "updated" event.
     *
     * @param UserDocument $userDocument
     * @return void
     */
    public function updated(UserDocument $userDocument)
    {
        //
    }

    /**
     * Handle the UserDocument "deleted" event.
     *
     * @param UserDocument $userDocument
     * @return void
     */
    public function deleted(UserDocument $userDocument)
    {
        $userEvaluationUpdate = new UserScoreEvaluator($userDocument->user);
        $userEvaluationUpdate->updateScore();
    }

    /**
     * Handle the UserDocument "restored" event.
     *
     * @param UserDocument $userDocument
     * @return void
     */
    public function restored(UserDocument $userDocument)
    {
        //
    }

    /**
     * Handle the UserDocument "force deleted" event.
     *
     * @param UserDocument $userDocument
     * @return void
     */
    public function forceDeleted(UserDocument $userDocument)
    {
        //
    }
}

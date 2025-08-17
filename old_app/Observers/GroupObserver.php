<?php

namespace App\Observers;

use App\Enums\GroupUserStatusEnum;
use App\Models\Group;
use App\Services\SlugGeneratorService;

class GroupObserver
{
    /**
     * Handle the Group "created" event.
     *
     * @param Group $group
     *
     * @return void
     */
    public function creating(Group $group)
    {
        $group->slug = $group::makeSlug($group->title);

    }

    /**
     * Handle the Group "created" event.
     *
     * @param Group $group
     *
     * @return void
     */
    public function created(Group $group)
    {
        //
    }

    /**
     * Handle the Group "updated" event.
     *
     * @param Group  $group
     *
     * @return void
     */
    public function updated(Group $group)
    {
        if ( $group->users()->count() === $group->max_capacity) {
            $group->status = GroupUserStatusEnum::getValue("completed");
        }

    }

    /**
     * Handle the Group "deleted" event.
     *
     * @param  Group  $group
     *
     * @return void
     */
    public function deleted(Group $group)
    {
        //
    }

    /**
     * Handle the Group "restored" event.
     *
     * @param  Group  $group
     *
     * @return void
     */
    public function restored(Group $group)
    {
        //
    }

    /**
     * Handle the Group "force deleted" event.
     *
     * @param  Group  $group
     *
     * @return void
     */
    public function forceDeleted(Group $group)
    {
        //
    }
}

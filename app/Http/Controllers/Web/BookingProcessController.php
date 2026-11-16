<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Tour;
use App\Enums\GroupStatusEnum;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BookingProcessController extends Controller
{
    /**
     *  Booking process - Step 1 - Tour and Group info summary
     *
     * @param Tour  $tour
     * @param Group $group
     *
     * @return Application|Factory|View
     */
    public function step1(Tour $tour, Group $group) {
        abort_unless($group->tour_id === $tour->id, 404);
        abort_unless($group->public && $group->status->value === GroupStatusEnum::registration
            && now()->toDateString() >= $group->start_registration_date
            && now()->toDateString() <= $group->end_registration_date
            && $group->users()->count() < $group->max_capacity, 409, 'Registration is closed for this group.');

        return view("booking-tour.booking-tour")->with('tour', $tour)->with('group', $group);
    }
}

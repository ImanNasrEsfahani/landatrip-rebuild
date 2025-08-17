<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Tour;
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
//        dd("step1");
        if($tour && $group) {
            return view("booking-tour.booking-tour")->with('tour', $tour)->with('group', $group);
        }
        return abort("4040", "This link is broken");
    }
}

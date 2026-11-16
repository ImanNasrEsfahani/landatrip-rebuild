<?php

namespace App\Http\Controllers\Web;

use App\Enums\GroupStatusEnum;
use App\Enums\InvoiceStatusEnum;
use App\Enums\TransactionStatusEnum;
use App\Events\FailsPaymentEvent;
use App\Events\SuccessPaymentEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentVerifyRequest;
use App\Http\Requests\StoreTourRequest;
use App\Http\Requests\UpdateTourRequest;
use App\Models\Invoice;
use App\Models\Tour;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Shetabit\Payment\Facade\Payment;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        return view('tour-filter.tour-filter');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTourRequest $request
     * @return Response
     */
    public function store(StoreTourRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Tour $tour
     * @return View
     */
    public function show(Tour $tour)
    {
//        dd($tour);
        if(app()->getLocale() === $tour->language()->first()->slug) {
            $lastGroup = $tour->groups()->latest()->first();
            $tourComments = $tour->tourComments()->where('verify_at', "!=", null)->get();
            return view("tour.tour")->with('tour', $tour)->with('lastGroup', $lastGroup)->with('tourComments', $tourComments);
        }
        return abort(404, "This tour is not for this language");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Tour $tour
     * @return Response
     */
    public function edit(Tour $tour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTourRequest $request
     * @param Tour $tour
     * @return Response
     */
    public function update(UpdateTourRequest $request, Tour $tour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tour $tour
     * @return Response
     */
    public function destroy(Tour $tour)
    {
        //
    }

    /**
     * Book a tour
     * @param Tour $tour
     * @param $tourOperation
     * @return RedirectResponse|void
     * @throws Exception
     */
    public function booking($tour, $tourOperation)
    {
        $tour = Tour::where('slug', $tour)->firstOrFail();
        $group = $tour->groups()->findOrFail($tourOperation);
        abort_unless($group->public && $group->status->value === GroupStatusEnum::registration
            && now()->toDateString() >= $group->start_registration_date
            && now()->toDateString() <= $group->end_registration_date
            && $group->users()->count() < $group->max_capacity, 409, 'Registration is closed for this group.');

        // The stored price items do not define the selected package, traveller
        // quantities, tax, or gateway currency. Charging would invent a price.
        abort(409, 'Invoice pricing is not configured for booking.');
    }

    /**
     * @param StorePaymentVerifyRequest $request
     * @return mixed
     */
    public function verification(StorePaymentVerifyRequest $request): mixed
    {
        [$transactionObj, $completed, $changed] = DB::transaction(function () use ($request) {
            $transaction = Transaction::where('authority', $request->validated('Authority'))
                ->lockForUpdate()->firstOrFail();
            abort_if($transaction->provider === 'fake', 404);

            if ($transaction->status->value !== TransactionStatusEnum::pending) {
                return [$transaction, $transaction->status->value === TransactionStatusEnum::completed, false];
            }

            $invoice = Invoice::whereKey($transaction->invoice_id)->lockForUpdate()->firstOrFail();
            abort_if($invoice->pricing_version === config('booking_test.pricing_version'), 404);
            if ($invoice->status->value === InvoiceStatusEnum::paid) {
                return [$transaction, true, false];
            }
            abort_unless($invoice->status->value === InvoiceStatusEnum::pending
                && ($invoice->expire->isToday() || $invoice->expire->isFuture()), 409, 'Invoice is no longer payable.');

            if ($request->validated('Status') !== 'OK') {
                $transaction->update(['status' => TransactionStatusEnum::failed]);
                return [$transaction, false, true];
            }

            Payment::amount((int) $invoice->total)
                ->transactionId($transaction->authority)
                ->verify();
            $transaction->update(['status' => TransactionStatusEnum::completed]);
            $invoice->update(['status' => InvoiceStatusEnum::paid]);

            return [$transaction, true, true];
        });

        if ($changed) {
            if ($completed) {
                SuccessPaymentEvent::dispatch($transactionObj);
            } else {
                FailsPaymentEvent::dispatch($transactionObj);
            }
        }

        return view($completed ? 'payment-result.payment-successful' : 'payment-result.payment-failure');
    }
}

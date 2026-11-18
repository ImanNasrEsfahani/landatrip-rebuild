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
    public function index(\Illuminate\Http\Request $request)
    {
        $input = $request->validate(['q' => ['nullable', 'string', 'max:100'], 'page' => ['nullable', 'integer', 'min:1']]);
        $search = trim($input['q'] ?? '');
        $query = Tour::publiclyVisible()
            ->select(['id', 'title', 'slug', 'short_summary'])
            ->withCount(['groups as public_groups_count' => fn ($query) => $query
                ->publiclyVisible()]);
        if ($search !== '') {
            $escaped = str_replace(['\\', '%', '_'], ['\\\\', '\\%', '\\_'], $search);
            $query->where('title', 'like', '%'.$escaped.'%');
        }
        $tours = $query->orderBy('title')->orderBy('id')->paginate(12)->appends(['q' => $search]);
        $listing = [
            'items' => $tours->getCollection()->map(fn ($tour) => [
                'id' => $tour->id, 'title' => $tour->title, 'summary' => $tour->short_summary,
                'groups' => $tour->public_groups_count,
                'url' => $tour->public_groups_count > 0 ? route('tour.show', $tour->slug) : null,
            ]),
            'q' => $search, 'page' => $tours->currentPage(), 'total' => $tours->total(),
            'previous' => $tours->previousPageUrl(), 'next' => $tours->nextPageUrl(),
        ];
        return view('tour-filter.tour-filter', compact('listing'));
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
        abort_unless(Tour::publiclyVisible()->whereKey($tour->id)->exists(), 404);
        if(app()->getLocale() === $tour->language()->first()->slug) {
            $lastGroup = $tour->groups()->publiclyVisible()->latest()->orderByDesc('id')->firstOrFail();
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
        $tour = Tour::publiclyVisible()->where('slug', $tour)->firstOrFail();
        $group = $tour->groups()->publiclyVisible()->findOrFail($tourOperation);
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

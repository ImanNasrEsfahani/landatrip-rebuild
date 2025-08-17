<?php

namespace App\Http\Controllers\Web;

use App\Enums\GroupStatusEnum;
use App\Enums\TransactionStatusEnum;
use App\Events\FailsPaymentEvent;
use App\Events\SuccessPaymentEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentVerifyRequest;
use App\Http\Requests\StoreTourRequest;
use App\Http\Requests\UpdateTourRequest;
use App\Models\Group;
use App\Models\Invoice;
use App\Models\Tour;
use App\Models\Transaction;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Shetabit\Multipay\Invoice as ZarinPalInvoice;
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
        $tourOperation = Group::find($tourOperation);

        if ($tourOperation->status->value !== GroupStatusEnum::registration) {
           return redirect()->back()->with('error', 'This tour is not possible to be booked.');
        }

        $amount = (int) ($tour->groups()->latest()->first()->price * 51000);
        $description = 'Travel course: ' . $tour->title;

        // Create new invoice.
        $invoice = (new ZarinPalInvoice)->amount($amount);
        $invoiceModel = Invoice::create([
                                'user_id'       =>  1,
                                'coupon_id'     =>  null,
                                'title'         =>  $description,
                                'total'         =>  $amount,
                                'discount'      =>  0,
                                'tax'           =>  0,
                                'subtotal'      =>  $amount,
                                'expire'        =>  Carbon::now()->addDay(2)
                            ]);

        //dd($invoiceModel);

        // Purchase the given invoice.
        return Payment::purchase($invoice,function($driver, $transactionId) use ($invoiceModel, $amount, $description){
            // We can store $transactionId in database.
            Transaction::create([
                'invoice_id'            =>  $invoiceModel->id,
                'amount'                =>  $amount,
                'transaction info'      =>  $description,
                'phone'                 =>  '09131193442',
                'email'                 =>  'info@landatrip.com',
                'authority'             =>  $transactionId
            ]);
        })->pay()->render();
    }

    /**
     * @param StorePaymentVerifyRequest $request
     * @return mixed
     */
    public function verification(StorePaymentVerifyRequest $request): mixed
    {
        $transactionObj = Transaction::where('authority', '=', $request->validated('Authority'))->firstOrFail();
        if(!$transactionObj) Log::critical("Transaction is not found in db with authority = " . $request->validated('Authority'));

        $transactionObj->update([ "status" =>  $request->validated('Status') === "OK" ? TransactionStatusEnum::completed : TransactionStatusEnum::failed ]);

        if ($transactionObj === TransactionStatusEnum::completed) {
           SuccessPaymentEvent::dispatch($transactionObj);
           return view("payment-result.payment-successful");
        }

        FailsPaymentEvent::dispatch($transactionObj);
        return view("payment-result.payment-failure");
    }
}

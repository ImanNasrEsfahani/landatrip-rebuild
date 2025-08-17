<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Exception\CardException;
use Stripe\Stripe;
use Stripe\StripeClient;

class StripeGatewayController extends Controller
{

    public function index()
    {
        return view('test.test');
     }


    public function store(Request $request)
    {
//        try {
//            $stripe = new StripeClient(env('STRIPE_SECRET'));

//            $stripe->paymentIntents->create([
//                'amount' => 99 * 100,
//                'currency' => 'usd',
//                'automatic_payment_methods' => [
//                    'enabled' => true,
//                ],
//                'description' => 'Demo payment with stripe',
//                'confirm' => true,
//            ]);
//        } catch (CardException $th) {
//            throw new Exception("There was a problem processing your payment", 1);
//        }

//        return back()->withSuccess('Payment done.');

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'line_item' => [
                'price_data'    =>  [
                    'currency'  =>  'usd',
                    'product_data'  => [
                        'name'  =>  'asghar'
                    ],
                    'unit_amount'   =>  500,
                ],
                'quantity'=> 1,
            ],
            'mode'=>    'payment',
            'success_url'   =>  route('stripe.success'),
            'cansel_url'   =>  route('stripe.success')
        ]);

        return redirect()->away($session->url);

    }

    public function success()
    {
        return "success";
    }
}


<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TestCheckout;
use Illuminate\Http\Request;

class TestCheckoutController extends Controller
{
    public function quote(Request $request, string $group, TestCheckout $checkout)
    {
        $checkout->guard();
        return response()->json($checkout->quote($group, $request->only(['participants', 'extras'])));
    }

    public function create(Request $request, string $group, TestCheckout $checkout)
    {
        $checkout->guard();
        $key = $request->input('checkout_key');
        abort_unless(is_string($key) && preg_match('/^[A-Za-z0-9_-]{8,80}$/', $key), 422, 'Invalid checkout key.');
        return response()->json($checkout->create($group, (string) $request->user()->id,
            $request->only(['participants', 'extras']), $key), 201);
    }

    public function show(Request $request, string $invoice, TestCheckout $checkout)
    {
        return response()->json($checkout->invoice($invoice, (string) $request->user()->id));
    }

    public function initiate(Request $request, string $invoice, TestCheckout $checkout)
    {
        return response()->json($checkout->initiate($invoice, (string) $request->user()->id));
    }

    public function callback(Request $request, TestCheckout $checkout)
    {
        $checkout->guard();
        $data = $request->validate([
            'authority' => ['required', 'string', 'regex:/^fake_[A-Za-z0-9]{32}$/'],
            'result' => ['required', 'in:success,failure'],
        ]);
        return response()->json($checkout->callback($data['authority'], $data['result']));
    }

    public function expire(Request $request, string $invoice, TestCheckout $checkout)
    {
        return response()->json($checkout->expireForTest($invoice, (string) $request->user()->id));
    }
}

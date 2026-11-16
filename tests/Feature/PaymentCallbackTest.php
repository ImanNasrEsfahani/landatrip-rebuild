<?php

namespace Tests\Feature;

use App\Enums\InvoiceStatusEnum;
use App\Enums\TransactionStatusEnum;
use App\Events\FailsPaymentEvent;
use App\Events\SuccessPaymentEvent;
use App\Models\Invoice;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Mockery;
use RuntimeException;
use Shetabit\Multipay\Contracts\ReceiptInterface;
use Shetabit\Payment\Facade\Payment;
use Tests\TestCase;

class PaymentCallbackTest extends TestCase
{
    use DatabaseTransactions;

    private function pendingTransaction(): Transaction
    {
        $invoice = Invoice::create([
            'title' => 'Disposable test invoice',
            'user_id' => (string) Str::ulid(),
            'total' => 250,
            'discount' => 0,
            'tax' => 0,
            'subtotal' => 250,
            'expire' => now()->addDay(),
        ]);

        return Transaction::create([
            'invoice_id' => $invoice->id,
            'authority' => 'e2e-authority-' . Str::random(16),
            'session_id' => 'e2e-session',
        ]);
    }

    public function test_success_is_verified_once_and_marks_invoice_paid(): void
    {
        Event::fake([SuccessPaymentEvent::class, FailsPaymentEvent::class]);
        $transaction = $this->pendingTransaction();

        Payment::shouldReceive('amount')->once()->with(250)->andReturnSelf();
        Payment::shouldReceive('transactionId')->once()->with($transaction->authority)->andReturnSelf();
        Payment::shouldReceive('verify')->once()->andReturn(Mockery::mock(ReceiptInterface::class));

        $url = '/payment/verify?Authority=' . $transaction->authority . '&Status=OK';
        $this->get($url)->assertSuccessful()->assertViewIs('payment-result.payment-successful');
        $this->get($url)->assertSuccessful()->assertViewIs('payment-result.payment-successful');

        $this->assertSame(TransactionStatusEnum::completed, $transaction->fresh()->status->value);
        $this->assertSame(InvoiceStatusEnum::paid, $transaction->invoice->fresh()->status->value);
        Event::assertDispatchedTimes(SuccessPaymentEvent::class, 1);
        Event::assertNotDispatched(FailsPaymentEvent::class);
    }

    public function test_failed_callback_is_terminal_and_never_calls_gateway(): void
    {
        Event::fake([SuccessPaymentEvent::class, FailsPaymentEvent::class]);
        $transaction = $this->pendingTransaction();
        Payment::shouldReceive('amount')->never();

        $url = '/payment/verify?Authority=' . $transaction->authority . '&Status=NOK';
        $this->get($url)->assertSuccessful()->assertViewIs('payment-result.payment-failure');
        $this->get($url)->assertSuccessful()->assertViewIs('payment-result.payment-failure');

        $this->assertSame(TransactionStatusEnum::failed, $transaction->fresh()->status->value);
        $this->assertSame(InvoiceStatusEnum::pending, $transaction->invoice->fresh()->status->value);
        Event::assertDispatchedTimes(FailsPaymentEvent::class, 1);
        Event::assertNotDispatched(SuccessPaymentEvent::class);
    }

    public function test_gateway_error_keeps_transaction_pending_for_retry(): void
    {
        Event::fake([SuccessPaymentEvent::class, FailsPaymentEvent::class]);
        $transaction = $this->pendingTransaction();

        Payment::shouldReceive('amount')->once()->with(250)->andReturnSelf();
        Payment::shouldReceive('transactionId')->once()->with($transaction->authority)->andReturnSelf();
        Payment::shouldReceive('verify')->once()->andThrow(new RuntimeException('Synthetic gateway failure'));

        $this->get('/payment/verify?Authority=' . $transaction->authority . '&Status=OK')
            ->assertInternalServerError();

        $this->assertSame(TransactionStatusEnum::pending, $transaction->fresh()->status->value);
        $this->assertSame(InvoiceStatusEnum::pending, $transaction->invoice->fresh()->status->value);
        Event::assertNotDispatched(SuccessPaymentEvent::class);
        Event::assertNotDispatched(FailsPaymentEvent::class);
    }

    public function test_second_transaction_cannot_verify_an_already_paid_invoice(): void
    {
        Event::fake([SuccessPaymentEvent::class, FailsPaymentEvent::class]);
        $first = $this->pendingTransaction();
        $second = Transaction::create([
            'invoice_id' => $first->invoice_id,
            'authority' => 'e2e-authority-' . Str::random(16),
            'session_id' => 'e2e-second-session',
        ]);
        $first->invoice->update(['status' => InvoiceStatusEnum::paid]);
        Payment::shouldReceive('amount')->never();

        $this->get('/payment/verify?Authority=' . $second->authority . '&Status=OK')
            ->assertSuccessful()->assertViewIs('payment-result.payment-successful');
        $this->assertSame(TransactionStatusEnum::pending, $second->fresh()->status->value);
        Event::assertNotDispatched(SuccessPaymentEvent::class);
    }
}

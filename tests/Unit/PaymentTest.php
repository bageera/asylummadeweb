<?php

namespace Tests\Unit;

use App\Models\Payment;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    /** @test */
    public function it_has_correct_status_constants()
    {
        $this->assertEquals('pending', Payment::STATUS_PENDING);
        $this->assertEquals('processing', Payment::STATUS_PROCESSING);
        $this->assertEquals('succeeded', Payment::STATUS_SUCCEEDED);
        $this->assertEquals('failed', Payment::STATUS_FAILED);
        $this->assertEquals('refunded', Payment::STATUS_REFUNDED);
    }

    /** @test */
    public function it_checks_succeeded_status()
    {
        $payment = new Payment(['status' => Payment::STATUS_SUCCEEDED]);
        $this->assertTrue($payment->isSucceeded());
        $this->assertFalse($payment->isFailed());
        $this->assertFalse($payment->isPending());
    }

    /** @test */
    public function it_checks_failed_status()
    {
        $payment = new Payment(['status' => Payment::STATUS_FAILED]);
        $this->assertTrue($payment->isFailed());
        $this->assertFalse($payment->isSucceeded());
    }

    /** @test */
    public function it_checks_pending_status()
    {
        $payment = new Payment(['status' => Payment::STATUS_PENDING]);
        $this->assertTrue($payment->isPending());
        $this->assertFalse($payment->isSucceeded());
    }

    /** @test */
    public function it_checks_refunded_status()
    {
        $payment = new Payment(['status' => Payment::STATUS_REFUNDED]);
        $this->assertTrue($payment->isRefunded());
    }

    /** @test */
    public function it_formats_usd_amount()
    {
        $payment = new Payment(['amount' => 100.00, 'currency' => 'USD']);
        $this->assertEquals('$100.00', $payment->getFormattedAmount());
    }

    /** @test */
    public function it_formats_eur_amount()
    {
        $payment = new Payment(['amount' => 50.50, 'currency' => 'EUR']);
        $this->assertEquals('€50.50', $payment->getFormattedAmount());
    }

    /** @test */
    public function it_formats_unknown_currency()
    {
        $payment = new Payment(['amount' => 25.00, 'currency' => 'JPY']);
        $this->assertEquals('JPY 25.00', $payment->getFormattedAmount());
    }
}
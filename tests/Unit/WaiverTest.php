<?php

namespace Tests\Unit;

use App\Models\Waiver;
use App\Models\WaiverTemplate;
use Tests\TestCase;
use Carbon\Carbon;

class WaiverTest extends TestCase
{
    /** @test */
    public function it_checks_if_expired()
    {
        $waiver = new Waiver([
            'expires_at' => Carbon::now()->addDays(30),
        ]);
        $this->assertFalse($waiver->isExpired());

        $waiver->expires_at = Carbon::now()->subDay();
        $this->assertTrue($waiver->isExpired());

        $waiver->expires_at = null;
        $this->assertFalse($waiver->isExpired());
    }

    /** @test */
    public function it_checks_if_valid()
    {
        $waiver = new Waiver([
            'is_valid' => true,
            'expires_at' => Carbon::now()->addDays(30),
        ]);
        $this->assertTrue($waiver->isValid());

        $waiver->is_valid = false;
        $this->assertFalse($waiver->isValid());

        $waiver->is_valid = true;
        $waiver->expires_at = Carbon::now()->subDay();
        $this->assertFalse($waiver->isValid());
    }

    /** @test */
    public function it_marks_invalid()
    {
        $waiver = new Waiver(['is_valid' => true]);
        $waiver->markInvalid();
        $this->assertFalse($waiver->is_valid);
    }
}
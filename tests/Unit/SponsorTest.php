<?php

namespace Tests\Unit;

use App\Models\Sponsor;
use App\Models\Event;
use Tests\TestCase;

class SponsorTest extends TestCase
{
    /** @test */
    public function it_has_correct_tier_constants()
    {
        $this->assertEquals(1, Sponsor::TIER_BRONZE);
        $this->assertEquals(2, Sponsor::TIER_SILVER);
        $this->assertEquals(3, Sponsor::TIER_GOLD);
        $this->assertEquals(4, Sponsor::TIER_PLATINUM);
    }

    /** @test */
    public function it_returns_tier_name()
    {
        $sponsor = new Sponsor(['tier' => 4]);
        $this->assertEquals('Platinum', $sponsor->getTierName());

        $sponsor->tier = 3;
        $this->assertEquals('Gold', $sponsor->getTierName());

        $sponsor->tier = 2;
        $this->assertEquals('Silver', $sponsor->getTierName());

        $sponsor->tier = 1;
        $this->assertEquals('Bronze', $sponsor->getTierName());
    }

    /** @test */
    public function it_checks_platinum_tier()
    {
        $sponsor = new Sponsor(['tier' => 4]);
        $this->assertTrue($sponsor->isPlatinum());
        $this->assertFalse($sponsor->isGold());
    }

    /** @test */
    public function it_checks_gold_tier()
    {
        $sponsor = new Sponsor(['tier' => 3]);
        $this->assertTrue($sponsor->isGold());
        $this->assertFalse($sponsor->isPlatinum());
    }

    /** @test */
    public function it_returns_default_logo_when_none_set()
    {
        $sponsor = new Sponsor(['name' => 'Test Sponsor']);
        $this->assertStringContainsString('default-sponsor.png', $sponsor->getLogoUrl());
    }

    /** @test */
    public function it_returns_storage_logo_when_set()
    {
        $sponsor = new Sponsor(['name' => 'Test Sponsor', 'logo_path' => 'sponsors/logo.png']);
        $this->assertStringContainsString('storage/sponsors/logo.png', $sponsor->getLogoUrl());
    }
}
<?php

namespace Tests\Unit;

use App\Campaign;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Migrations\Migration;

class CampaignTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

    public function testTrueIsTrue()
    {
      $foo = true;
      $this->assertTrue($foo);
    }
}

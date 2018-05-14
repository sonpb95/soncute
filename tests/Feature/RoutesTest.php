<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoutesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndexPageResponseOK()
    {
      $response = $this->call('GET', '/');

      $response->assertStatus(200);
    }

    public function testCampaignPageResponseOK()
    {
      $response = $this->call('GET', '/campaigns/1');

      $response->assertStatus(200);
    }

    public function testUserProfilePageResponseOK()
    {
      $response = $this->call('GET', '/users/1');

      $response->assertStatus(200);
    }

    public function testUserProfileWithTabIDPageResponseOK()
    {
      $response = $this->call('GET', '/users/1/1');

      $response->assertStatus(200);
    }

    public function testCategoryPageResponseOK()
    {
      $response = $this->call('GET', '/categories/1');

      $response->assertStatus(200);
    }

    public function testDiscoverPageResponseOK()
    {
      $response = $this->call('GET', '/discover');

      $response->assertStatus(200);
    }

    public function testNowLauchedPageResponseOK()
    {
      $response = $this->call('GET', '/now-launched');

      $response->assertStatus(200);
    }

    public function testEndingSoonPageResponseOK()
    {
      $response = $this->call('GET', '/ending-soon');

      $response->assertStatus(200);
    }

    public function testSmallProjectPageResponseOK()
    {
      $response = $this->call('GET', '/small-project');

      $response->assertStatus(200);
    }

    public function testPaymentProcessWithPerkIDPageResponseOK()
    {
      $response = $this->call('GET', '/payment/process/1');

      $response->assertStatus(200);
    }

    public function testPaymentWithPerkIDPageResponseOK()
    {
      $response = $this->call('GET', '/payment/1');

      $response->assertStatus(200);
    }

    public function testContactPageResponseOK()
    {
      $response = $this->call('GET', '/contact');

      $response->assertStatus(200);
    }

    public function testHowItWorkPageResponseOK()
    {
      $response = $this->call('GET', '/how-it-work');

      $response->assertStatus(200);
    }

    public function testNewsPageResponseOK()
    {
      $response = $this->call('GET', '/news');

      $response->assertStatus(200);
    }

    public function testArticalPageResponseOK()
    {
      $response = $this->call('GET', '/article');

      $response->assertStatus(200);
    }

    public function testBlogPageResponseOK()
    {
      $response = $this->call('GET', '/blog');

      $response->assertStatus(200);
    }
}

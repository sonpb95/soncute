<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
  use DatabaseTransactions;

 protected $user;
 protected $password = 'testpass123';

 public function get_user()
 {
     if ($this->user) return;

     $this->user = factory(User::class)->create([
         'email' => 'tuan@example.com',
         'password' => bcrypt($this->password),
     ]);
 }

 /** @test */
 public function test_a_user_can_successfully_log_in()
 {
     $this->get_user();
     $this->visit(route('login'));
     $this->type($this->user->email, 'email');
     $this->type($this->password, 'password');
     $this->press('Login');
     $this->seePageIs(route('index'));
 }

 /** @test */
 public function test_a_user_receives_errors_for_wrong_login_credentials()
 {
     $this->visit(route('login'));
     $this->type($this->user->email, 'email');
     $this->type('invalid-password', 'password');
     $this->press('Login');
     $this->see('These credentials do not match our records.');
 }

 /** @test */
 public function test_a_user_is_redirected_to_dashboard_if_logged_in_and_tries_to_access_login_page()
 {
     $this->get_user();

     $this->actingAs($this->user);

     $this->visit(route('login'));
     $this->seePageIs(route('index'));
 }

 /** @test */
 public function test_a_user_is_redirected_to_login_page_if_not_logged_in_and_trying_to_access_dashboard()
 {
     $this->get_user();
     $this->visit(route('dashboard'));
     $this->seePageIs(route('login'));
 }
}

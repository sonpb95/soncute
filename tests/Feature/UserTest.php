<?php

namespace Tests\Feature;

use App\User;
use App\UserDetail;
use Tests\TestCase;
use Tests\WithStubUser;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use WithStubUser;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_user_register()
    {
        $user = factory(User::class)->create();
        UserDetail::create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)
                         ->withSession(['foo' => 'bar'])
                         ->get('/');

        $this->assertDatabaseHas('users',$user->toArray());
    }

    public function test_user_browse_discover()
    {
        $response = $this->get('/discover');

        $response->assertStatus(200);
    }

    public function test_profile_view()
    {
        $user = $this->createStubUser();
        $response = $this->actingAs($user)->get('/user_id/'.$user->id);
        $response->assertStatus(200);
        $response->assertViewHas('Trang cá nhân');
        $response->assertSee('<form method="post" action="/users/'.$user->id.'/update">');
    }
}

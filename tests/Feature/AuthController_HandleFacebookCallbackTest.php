<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use VCR\VCR;

use App\User;

class AuthController_HandleFacebookCallbackTest extends TestCase
{
    use DatabaseTransactions;

    static function setUpBeforeClass()
    {
        VCR::configure()->enableLibraryHooks(['stream_wrapper', 'curl'])
            ->enableRequestMatchers([
                'method',
                'url',
            ]);
    }

    /**
     * @vcr facebook
     */
    function testCreatesUserWithCorrespondingName()
    {
        $this->doCallbackRequest();

        $this->assertEquals('John Doe', User::first()->name);
    }

    /**
     * @vcr facebook
     */
    function testCreatesUserWithCorrespondingEmail()
    {
        $this->doCallbackRequest();

        $this->assertEquals('john.doe@gmail.com', User::first()->email);
    }

    /**
     * @vcr facebook
     */
    function testCreatesUserWithCorrespondingFbId()
    {
        $this->doCallbackRequest();

        $this->assertEquals(123, User::first()->fb_id);
    }

    /**
     * @vcr facebook
     */
    function testCreatesUserWithFbData()
    {
        $this->doCallbackRequest();

        $this->assertNotEquals('', User::first()->fb_data);
    }

    /**
     * @vcr facebook
     */
    function testRedirectsToHomePage()
    {
        $this->doCallbackRequest();

        $this->assertRedirectedTo('/');
    }

    /**
     * @vcr facebook
     */
    function testAuthenticatesUser()
    {
        $this->doCallbackRequest();

        $this->assertEquals(User::first()->id, Auth::user()->id);
    }

    /**
     * @vcr facebook
     */
    function testDoesntCreateUserIfAlreadyExists()
    {
        $user = factory(User::class)->create([
            'fb_id' => 123,
        ]);

        $this->doCallbackRequest();

        $this->assertEquals(1, User::count());
    }

    function doCallbackRequest()
    {
        return $this->withSession([
            'state' => '...',
        ])->get('/auth/facebook/callback?' . http_build_query([
            'state' => '...',
        ]));
    }
}

<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use VCR\VCR;

use App\User;

class AuthController_HandleGoogleCallbackTest extends TestCase
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
     * @vcr google
     */
    function testCreatesUserWithCorrespondingName()
    {
        $this->doCallbackRequest();

        $this->assertEquals('John Doe', User::first()->name);
    }

    /**
     * @vcr google
     */
    function testCreatesUserWithCorrespondingEmail()
    {
        $this->doCallbackRequest();

        $this->assertEquals('john.doe@gmail.com', User::first()->email);
    }

    /**
     * @vcr google
     */
    function testCreatesUserWithCorrespondingGpId()
    {
        $this->doCallbackRequest();

        $this->assertEquals(123, User::first()->gp_id);
    }

    /**
     * @vcr google
     */
    function testCreatesUserWithGpData()
    {
        $this->doCallbackRequest();

        $this->assertNotEquals('', User::first()->gp_data);
    }

    /**
     * @vcr google
     */
    function testRedirectsToHomePage()
    {
        $this->doCallbackRequest();

        $this->assertRedirectedTo('/');
    }

    /**
     * @vcr google
     */
    function testAuthenticatesUser()
    {
        $this->doCallbackRequest();

        $this->assertEquals(User::first()->id, Auth::user()->id);
    }

    /**
     * @vcr google
     */
    function testDoesntCreateUserIfAlreadyExists()
    {
        $user = factory(User::class)->create([
            'gp_id' => 123,
        ]);

        $this->doCallbackRequest();

        $this->assertEquals(1, User::count());
    }

    function doCallbackRequest()
    {
        return $this->withSession([
            'state' => '...',
        ])->get('/auth/google/callback?' . http_build_query([
            'state' => '...',
        ]));
    }
}

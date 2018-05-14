<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_loginwithfakeuser()
    {
	    $response = $this->call('POST', '/login', [
	        'email' => 'badUsername0@gmail.com',
	        'password' => 'badPass',
	        '_token' => csrf_token()
	    ]);
	        $this->followRedirects($response)
        ->see('login');
    }

    public function test_loginwithfakeuser1()
    {
	    $response = $this->call('POST', '/login', [
	        'email' => 'badUsername1@gmail.com',
	        'password' => 'badPass',
	        '_token' => csrf_token()
	    ]);
	        $this->followRedirects($response)
        ->see('login');
    }

    public function test_loginwithfakeuser2()
    {
	    $response = $this->call('POST', '/login', [
	        'email' => 'badUsername2@gmail.com',
	        'password' => 'badPass',
	        '_token' => csrf_token()
	    ]);
	        $this->followRedirects($response)
        ->see('login');
    }   

    public function test_loginwithfakeuser3()
    {
	    $response = $this->call('POST', '/login', [
	        'email' => 'badUsername3@gmail.com',
	        'password' => 'badPass',
	        '_token' => csrf_token()
	    ]);
	        $this->followRedirects($response)
        ->see('login');
    }   

    public function test_loginwithfakeuser4()
    {
	    $response = $this->call('POST', '/login', [
	        'email' => 'badUsername4@gmail.com',
	        'password' => 'badPass',
	        '_token' => csrf_token()
	    ]);
	        $this->followRedirects($response)
        ->see('login');
    }     

    public function test_loginwithfakeuser5()
    {
	    $response = $this->call('POST', '/login', [
	        'email' => 'badUsername5@gmail.com',
	        'password' => 'badPass',
	        '_token' => csrf_token()
	    ]);
	        $this->followRedirects($response)
        ->see('login');
    } 
    public function test_loginwithfakeuser6()
    {
	    $response = $this->call('POST', '/login', [
	        'email' => 'badUsername6@gmail.com',
	        'password' => 'badPass',
	        '_token' => csrf_token()
	    ]);
	        $this->followRedirects($response)
        ->see('login');
    }  

    public function test_loginwithfakeuser7()
    {
	    $response = $this->call('POST', '/login', [
	        'email' => 'badUsername7@gmail.com',
	        'password' => 'badPass',
	        '_token' => csrf_token()
	    ]);
	        $this->followRedirects($response)
        ->see('login');
    }  

    public function test_loginwithfakeuser8()
    {
	    $response = $this->call('POST', '/login', [
	        'email' => 'badUsername8@gmail.com',
	        'password' => 'badPass',
	        '_token' => csrf_token()
	    ]);
	        $this->followRedirects($response)
        ->see('login');
    }  

    public function test_loginwithfakeuser9()
    {
	    $response = $this->call('POST', '/login', [
	        'email' => 'badUsername9@gmail.com',
	        'password' => 'badPass',
	        '_token' => csrf_token()
	    ]);
	        $this->followRedirects($response)
        ->see('login');
    }      
    public function test_loginwithfakeuser10()
    {
	    $response = $this->call('POST', '/login', [
	        'email' => 'badUsername10@gmail.com',
	        'password' => 'badPass',
	        '_token' => csrf_token()
	    ]);
	        $this->followRedirects($response)
        ->see('login');
    }    

    public function test_loginwithfakeuser11()
    {
	    $response = $this->call('POST', '/login', [
	        'email' => 'badUsername11@gmail.com',
	        'password' => 'badPass',
	        '_token' => csrf_token()
	    ]);
	        $this->followRedirects($response)
        ->see('login');
    } 

    public function test_loginwithfakeuser12()
    {
	    $response = $this->call('POST', '/login', [
	        'email' => 'badUsername12@gmail.com',
	        'password' => 'badPass',
	        '_token' => csrf_token()
	    ]);
	        $this->followRedirects($response)
        ->see('login');
    }       

    public function test_loginwithfakeuser13()
    {
	    $response = $this->call('POST', '/login', [
	        'email' => 'badUsername13@gmail.com',
	        'password' => 'badPass',
	        '_token' => csrf_token()
	    ]);
	        $this->followRedirects($response)
        ->see('login');
    }   

    public function test_loginwithfakeuser14()
    {
	    $response = $this->call('POST', '/login', [
	        'email' => 'badUsername14@gmail.com',
	        'password' => 'badPass',
	        '_token' => csrf_token()
	    ]);
	        $this->followRedirects($response)
        ->see('login');
    }    

    public function test_loginwithfakeuser15()
    {
	    $response = $this->call('POST', '/login', [
	        'email' => 'badUsername15@gmail.com',
	        'password' => 'badPass',
	        '_token' => csrf_token()
	    ]);
	        $this->followRedirects($response)
        ->see('login');
    }   

    public function test_loginwithfakeuser16()
    {
	    $response = $this->call('POST', '/login', [
	        'email' => 'badUsername16@gmail.com',
	        'password' => 'badPass',
	        '_token' => csrf_token()
	    ]);
	        $this->followRedirects($response)
        ->see('login');
    } 

    public function test_loginwithfakeuser17()
    {
	    $response = $this->call('POST', '/login', [
	        'email' => 'badUsername17@gmail.com',
	        'password' => 'badPass',
	        '_token' => csrf_token()
	    ]);
	        $this->followRedirects($response)
        ->see('login');
    }     

    public function test_loginwithfakeuser18()
    {
	    $response = $this->call('POST', '/login', [
	        'email' => 'badUsername18@gmail.com',
	        'password' => 'badPass',
	        '_token' => csrf_token()
	    ]);
	        $this->followRedirects($response)
        ->see('login');
    }    

    public function test_loginwithfakeuser19()
    {
	    $response = $this->call('POST', '/login', [
	        'email' => 'badUsername19@gmail.com',
	        'password' => 'badPass',
	        '_token' => csrf_token()
	    ]);
	        $this->followRedirects($response)
        ->see('login');
    }            

    public function test_loginwithfakeuser20()
    {
	    $response = $this->call('POST', '/login', [
	        'email' => 'badUsername20@gmail.com',
	        'password' => 'badPass',
	        '_token' => csrf_token()
	    ]);
	        $this->followRedirects($response)
        ->see('login');
    }            
}

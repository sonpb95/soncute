<?php
namespace Tests;
use App\User;
use App\UserDetail;

trait WithStubUser
{
    /**
     * @var \App\User
     */
    protected $user;
    public function createStubUser(array $data = [])
    {
        $data = array_merge([
            'name' => 'Test User',
            'email' => 'test-user-'.uniqid().'@example.com',
            'password' => bcrypt('123456'),
        ], $data);
        $this->user = User::create($data);
        UserDetail::create([
            'user_id' => $this->user->id,
        ]);

        return $this->user;  
    }
    public function deleteStubUser()
    {
        $this->user->forceDelete();
    }
}

<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    public $auth_info;
    public function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }
    
    public function createUser()
    {
        return User::factory()->create();
    }

    public function deleteUserByEmail($email)
    {   
        $user = User::where('email',$email)->first();
        if($user){
            $user->tokens()->delete();
            $user->delete();
        }
    }
}

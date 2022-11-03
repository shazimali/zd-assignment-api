<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class GetAuthTokenCase extends BaseTestCase
{
    use CreatesApplication;
    public static $auth_info;
    protected static $setUpHasRunOnce = false;
    public function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
        if (!static::$setUpHasRunOnce) {
            static::$auth_info = $this->createAuthToken();
            info('setUpHasRunOnce');
            static::$setUpHasRunOnce = true;
         }
       
    }

    public function createAuthToken()
    {
        $user = User::factory()->create();

        $response = $this->postJson(route('login'),[
            'email' => $user->email,
            'password' => 'password'
        ]);
        return $response;
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

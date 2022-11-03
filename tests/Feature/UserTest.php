<?php

namespace Tests\Feature;

use Tests\GetAuthTokenCase;
use App\Models\User;

class UserTest extends GetAuthTokenCase
{   
    public function test_users_list()
    {   
        $response = $this->withHeaders(['Accept' => 'application/json',
            'Authorization' => 'Bearer '.static::$auth_info['token']
        ])->get('/api/users',);
        $response->assertStatus(200);
    }

    public function test_store_user()
    {
        $data = User::factory()->make();
        $data = [
            'name' => $data->name,
            'email' => $data->email,
            'type' => $data->type,
            'password' => $data->password,
            'password_confirmation' => $data->password,
        ];
        $response = $this->withHeaders(['Accept' => 'application/json',
            'Authorization' => 'Bearer '.static::$auth_info['token']
        ])->post('/api/users/store',$data);
        $this->deleteUserByEmail($data['email']);
        $response->assertStatus(200);
    }

    public function test_edit_user()
    {
        $id = static::$auth_info['user']['_id']; 
        $response = $this->withHeaders(['Accept' => 'application/json',
            'Authorization' => 'Bearer '.static::$auth_info['token']
        ])->get('/api/users/edit/'.$id);

        $response->assertStatus(200);
    }

    public function test_update_user()
    {
        $id = static::$auth_info['user']['_id']; 
        $data = [
            'name' => 'smith',
            'email' => 'smith_gold@rana.com', 
            'type' => 'MANAGER', 
            'password' => 11223344,
            'password_confirmation' => 11223344,
        ];

        $response = $this->withHeaders(['Accept' => 'application/json',
            'Authorization' => 'Bearer '.static::$auth_info['token']
        ])->put('/api/users/update/'.$id,$data);

        $response->assertStatus(200);
    }

    public function test_delete_user()
    {
        $id = static::$auth_info['user']['_id']; 
        $response = $this->withHeaders(['Accept' => 'application/json',
            'Authorization' => 'Bearer '.static::$auth_info['token']
        ])->delete('/api/users/destroy/'.$id);
        $response->assertStatus(200);
    }
}


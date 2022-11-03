<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\GetAuthTokenCase;

class TaskTest extends GetAuthTokenCase
{

    public function test_tasks_list()
    {   
        $response = $this->withHeaders(['Accept' => 'application/json',
            'Authorization' => 'Bearer '.static::$auth_info['token']
        ])->get('/api/tasks/?type=MANAGER',);

        $response->assertStatus(200);
    }
}

<?php


namespace Tests\Unit;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_successfully(){
        $data=[
            'name'=>'test user',
            'email'=>'test@test.com',
            'password'=>'password',
        ];
        $response = $this->post('/api/register',$data);
        $response->assertStatus(201);
        $response->assertJson(
            ['message'=>'User registered Successfully']
        );
        $this->assertDatabaseHas('users',[
            'email'=>'test@test.com',
        ]);
    }

    public function test_user_login_successfully(){
        User::factory()->create(
            ['email'=>'test@test.com','password'=>'password']
        );
        $response=$this->post('/api/login',[
            'email'=>'test@test.com',
            'password'=>'password'
        ]);
        $response->assertStatus(200);
        $response->assertJson(
            ['message'=>'User Login Successfully']
        );
    }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register_form_responding()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
    }

    public function test_register_redirection_works_properly()
    {
        $user = User::factory()->make([
            'password' => bcrypt($password = 'password')
        ]);

        $response = $this->post('/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $password,
            'confirm_password' => $password
        ]);

        $response->assertRedirect('/');
    }

    public function test_is_name_required()
    {
        $user = User::factory()->make([
            'password' => bcrypt($password = 'password')
        ]);

        $response = $this->post('/register', [
            'email' => $user->email,
            'password' => $password,
            'confirm_password' => $password
        ]);

        $response->assertInvalid('name');
    }

    public function test_is_email_required()
    {
        $user = User::factory()->make([
            'password' => bcrypt($password = 'password')
        ]);

        $response = $this->post('/register', [
            'name' => $user->name,
            'password' => $password,
            'confirm_password' => $password
        ]);

        $response->assertInvalid('email');
    }
    
    public function test_is_password_required()
    {
        $user = User::factory()->make([
            'password' => bcrypt($password = 'password')
        ]);

        $response = $this->post('/register', [
            'name' => $user->name,
            'email' => $user->email,
            'confirm_password' => $password
        ]);

        $response->assertInvalid('password');
    }

    public function test_email_need_to_be_unique()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password')
        ]);

        $response = $this->post('/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $password,
            'confirm_password' => $password
        ]);

        $response->assertInvalid('email');
    }
    
    public function test_password_need_confirmation()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password')
        ]);

        $response = $this->post('/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $password,
            'confirm_password' => 'not_password'
        ]);

        $response->assertInvalid('password');
    }
}

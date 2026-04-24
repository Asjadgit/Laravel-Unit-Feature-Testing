<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserCrudTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    // public function test_example(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function test_can_list_users()
    {
        $response = $this->get('/users');
        $response->assertStatus(200);
        $response->assertViewIs('users.index');
    }

    public function test_name_is_required()
    {
        $response = $this->post('/users', [
            'name'      => '',
            'email'     => 'test@example.com',
            'password'  => 'password123',
            'role'      => 'Test',
        ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_email_is_required_and_valid()
    {
        $response = $this->post('/users', [
            'name'      => 'Test User',
            'email'     => 'invalid-email',
            'password'  => 'password123',
            'role'      => 'Test',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_password_must_be_at_least_6_characters()
    {
        $response = $this->post('/users', [
            'name'      => 'Test User',
            'email'     => 'test@example.com',
            'password'  => '123',
            'role'      => 'Test',
        ]);

        $response->assertSessionHasErrors('password');
    }

    public function test_role_is_required()
    {
        $response = $this->post('/users', [
            'name'      => 'Test User',
            'email'     => 'invalid-email',
            'password'  => 'password123',
            'role'      => '',
        ]);

        $response->assertSessionHasErrors('role');
    }

    public function test_can_create_user()
    {
        $response = $this->post('/users', [
            'name'      => 'Test User',
            'email'     => 'test@example.com',
            'password'  => 'password123',
            'role'      => 'Test',
        ]);

        $response->assertStatus(302); // redirect after store

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);
    }

    public function test_can_update_user()
    {
        $user = User::factory()->create();

        $response = $this->put("/users/{$user->id}", [
            'name'      => 'Updated Name',
            'email'     => 'updated@example.com',
            'password'  => 'password123',
            'role'      => 'Testing',
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ]);
    }

    public function test_can_delete_user()
    {
        $user = User::factory()->create();

        $response = $this->delete("/users/{$user->id}");

        $response->assertStatus(302);

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }
}

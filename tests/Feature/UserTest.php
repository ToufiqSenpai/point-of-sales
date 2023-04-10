<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_store_user_with_optional_field_success(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/user/add', [
            'name' => 'John Doe',
            'username' => 'johndoe',
            'password' => 'john123',
            'email' => 'john@gmail.com',
            'phone' => '+123456789'
        ]);

//        fwrite(STDERR, print_r($response->headers, true));
//        print_r('Ok', true);
        $response->assertRedirect(session()->previousUrl())->assertSessionHasNoErrors();
    }
}

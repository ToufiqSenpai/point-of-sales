<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PurchaseOrderTest extends TestCase
{
    public function test_set_supplier_success(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->followingRedirects()->post('/transaction/purchase-order?action=set_supplier', [
            'supplier_id' => 1
        ]);

        $response->assertRedirectContains('/transaction/purchase-order');
    }
}

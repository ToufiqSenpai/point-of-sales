<?php

namespace Tests\Feature;

use App\Models\PurchaseOrder;
use App\Models\User;
use App\Models\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class PurchaseOrderTest extends TestCase
{
    public PurchaseOrder $purchase_order;

    public function setUp(): void 
    {
        parent::setUp();
        $this->purchase_order = new PurchaseOrder();
        $this->purchase_order->save();
    }

    public function test_set_supplier_success(): void
    {
        $user = User::factory()->create();

        $supplier_id = Supplier::orderBy('id')->first()->id;

        $response =$this->actingAs($user)->post('/transaction/purchase-order?action=set_supplier&id='. $this->purchase_order->id, [
            'supplier_id' => $supplier_id
        ]);

        $response->assertSessionDoesntHaveErrors('error');
        $this->assertEquals($supplier_id, $this->purchase_order->refresh()->supplier_id);
        // $response->assertRedirectContains('/transaction/purchase-order');
    }

    public function test_add_product_success(): void
    {
        // $user = User::factory()->create();
        // $response = $this->actingAs($user)->followingRedirects()->post('/transaction')
    }
}

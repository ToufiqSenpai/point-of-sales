<?php

namespace Tests\Feature;

use App\Models\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SupplierTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

//        $response->assertRedirect();
    }

    public function test_get_supplier(): void
    {
        $supplier = Supplier::find(0);
        $this->assertNull($supplier);
    }

    /**
     * @throws \JsonException
     */
    public function test_store_supplier_success(): void
    {
        $response = $this->post('/supplier/add', [
            'name' => 'name'
        ]);
        $response->assertRedirect('/supplier')->assertSessionHasNoErrors();
    }
}

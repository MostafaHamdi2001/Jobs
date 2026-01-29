<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_products()
    {
        Product::withoutEvents(function(){

            Product::forceCreate([
                'title_en' => 'Test Product EN',
                'title_ar' => 'منتج تجريبي',
                'active'   => true,
            ]);
        });
        $response = $this->getJson('/api/products');
        $response->assertStatus(200)->assertJsonCount(3);
    }

    public function test_cannot_store_product_due_to_readonly_middleware()
    {
        $data = [
            'title_en' => 'New Product',
            'title_ar' => 'منتج جديد',
        ];

        $response = $this->postJson('/api/products', $data);

        $response->assertStatus(403)
            ->assertJson([
                     'status' => 'error',
                     'message' => 'عذراً، الموقع حالياً في وضع القراءة فقط. لا يمكن الإضافة أو التعديل.'
                 ]);
    }
}

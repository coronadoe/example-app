<?php

namespace Tests\Unit;

use App\Jobs\AddProduct;
use App\Jobs\DeleteProduct;
use App\Jobs\UpdateProduct;
use App\Models\Category;
use App\Models\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{

    protected $table = 'products';

    public function test_it_create_a_product() {
        $productValues = [
            'name' => 'new product',
            'price' => '34.50',
            'sku' => 'SOMERANDOMSKU',
            'categories' => [2,3,4]
        ];

        $addProduct = new AddProduct($productValues);
        $addProduct->handle();

        unset($productValues['categories']);

        $this->assertDatabaseHas($this->table, $productValues);
    }

    public function test_it_update_a_product() {
        $product = Product::factory()->create();

        $updateValues = [
            'name' => 'updated name',
            'price' => '9.99',
            'sku' => 'S0M3SK4YU'
        ];

        $updateProduct = new UpdateProduct($product, $updateValues);
        $updateProduct->handle();

        $this->assertDatabaseHas($this->table, $updateValues);

    }

    public function test_it_deletes_a_product()
    {
        $product = Product::factory()->create();
        $deleteProduct = new DeleteProduct($product);
        $deleteProduct->handle();

        $this->assertDeleted($this->table, ['id' => $product->id]);
    }
}

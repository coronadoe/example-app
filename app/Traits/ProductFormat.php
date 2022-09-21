<?php
namespace App\Traits;

use App\Models\Product;

trait ProductFormat {

    public function getProductFormat(Product $product) {
        $categories = $product->productCategories->map(function($productCategory) {
            return $productCategory->category->name;
        });

        return [
            'id' => $product->id,
            'name' => $product->name,
            'sku' => $product->sku,
            'categories' => $categories->toArray()
        ];
    }
}
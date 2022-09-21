<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $table = "products";

    protected $fillable = ['name', 'sku', 'price'];

    public function productCategories(): HasMany
    {
        return $this->hasMany(ProductCategory::class, 'product_id', 'id');
    }
}
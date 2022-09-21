<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model {
    
    protected $table = 'categories';

    public function productCategories(): HasMany
    {
        return $this->hasMany(ProductCategory::class, 'category_id', 'id');
    }
}
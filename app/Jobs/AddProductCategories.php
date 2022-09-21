<?php

namespace App\Jobs;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AddProductCategories implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $product;
    protected $productValues;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Product $product, array $productValues)
    {
        $this->product = $product;
        $this->productValues = $productValues;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $product = $this->product;
        collect($this->productValues['categories'])->each(function($value, $index) use ($product) {
            ProductCategory::create([
                'product_id' => $product->id,
                'category_id' => $value
                ]);
        });
    }
}

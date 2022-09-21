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

class AddProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $productValues;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $values)
    {
        $this->productValues = $values;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
         $product = new Product();
        $product->name = $this->productValues['name'];
        $product->price = $this->productValues['price'];
        $product->sku = $this->productValues['sku'];
        $product->save();

        collect($this->productValues['categories'])->each(function($value, $index) use ($product) {

            Log::info('Adding value ' . $value . ' to product id ' . $product->id);

            ProductCategory::create([
                'product_id' => $product->id,
                'category_id' => $value
                ]);
        });  

        

    }
}

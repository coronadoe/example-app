<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UpdateProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $product;
    protected $productValues;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Product $product, array $values)
    {
        $this->product = $product;
        $this->productValues = $values;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->product->update([
            'name' => $this->productValues['name'],
            'price' => $this->productValues['price'],
            'sku' => $this->productValues['sku']
        ]);
    }
}

<?php
namespace App\Http\Controllers;

use App\Jobs\AddProduct;
use App\Models\Product;
use App\Traits\ProductFormat;
use Illuminate\Http\Request;

class Products extends Controller
{
    use ProductFormat;

    /**
     * Display the list of products
     */
    public function index()
    {
        $products = Product::all();

        $productList = $products->map(function($product) {
            return $this->getProductFormat($product);
        });

        return response()->json(['products' => $productList]);
    }

    /**
     * Insert a new Product 
     */
    public function store(Request $request)
    {
        dispatch(new AddProduct($request->all()));
        return response()->json(['Success' => 'Product Created Successfully']);
    }

    /**
     * Retrieve the details of the product
     */
    public function show($id) 
    {
        $product = Product::find($id);
        if (!empty($product)) {
            return response()->json(['product' => $this->getProductFormat($product)]);
        } 
        
        return response()->json(['product' => "No product found"]);
    }

    /**
     * Update an existing product
     */
    public function update(Request $request, $id) 
    {
        $product = Product::findOrFail($id);
        dd($product);


        // $product->update($request->all());
        // return response()->json(['success' => "Product Updated Successfully"]);
    }

    /**
     * Destroy an existing product
     */
    public function destroy(Request $request, $id) 
    {
        $product = Product::findOrFail($id);
        return response()->json(['success' => "Product deleted Successfully"]);
    }
}
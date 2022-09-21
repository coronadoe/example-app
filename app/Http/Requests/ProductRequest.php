<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest {
    public function rules() {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|string',
            'sku' => 'required|string'
        ];
    }
}
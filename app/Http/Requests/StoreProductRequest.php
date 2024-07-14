<?php

namespace App\Http\Requests;

use App\Models\Product;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_create');
    }

    public function rules()
    {
        return [
            // 'nama' => [
            //     'string',
            //     'nullable',
            // ],
            // 'deskripsi' => [
            //     'string',
            //     'nullable',
            // ],
            // 'stock' => [
            //     'nullable',
            //     'integer',
            //     'min:-2147483648',
            //     'max:2147483647',
            // ],
            // 'product_id' => 'required|integer',
        ];
    }
}

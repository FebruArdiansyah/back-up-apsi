<?php

namespace App\Http\Requests;

use App\Models\Order;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOrderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('order_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'no_telepon' => [
                'string',
                'required',
            ],
            'email' => [
                'required',
                'email',
            ],
            'alamat' => [
                'required',
                'string',
            ],
            'products' => [
                'required',
                'array',
            ],
            'products.*' => [
                'integer',
            ],
            'quantities' => [
                'required',
                'array',
            ],
            'quantities.*' => [
                'integer',
                'min:1',
            ],
        ];
    }
}
<?php

namespace App\Http\Requests;

use Gate;
use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOrderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('order_edit');
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

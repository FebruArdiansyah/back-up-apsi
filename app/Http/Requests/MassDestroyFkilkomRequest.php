<?php

namespace App\Http\Requests;

use App\Models\Fkilkom;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFkilkomRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('fkilkom_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:fkilkoms,id',
        ];
    }
}

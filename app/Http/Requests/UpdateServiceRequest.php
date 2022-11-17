<?php

namespace App\Http\Requests;

use App\Models\Service;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateServiceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('service_edit');
    }

    public function rules()
    {
        return [
            'service_name' => [
                'string',
                'required',
            ],
            'service_description' => [
                'string',
                'nullable',
            ],
            'price' => [
                'numeric',
            ],
            'duration' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'service_providers.*' => [
                'integer',
            ],
            'service_providers' => [
                'array',
            ],
        ];
    }
}
<?php

namespace App\Http\Requests;

use App\Models\ServiceProvider;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreServiceProviderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('service_provider_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'phone' => [
                'string',
                'nullable',
            ],
            'services.*' => [
                'integer',
            ],
            'services' => [
                'array',
            ],
        ];
    }
}
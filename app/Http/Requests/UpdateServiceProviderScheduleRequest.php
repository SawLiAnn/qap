<?php

namespace App\Http\Requests;

use App\Models\ServiceProviderSchedule;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateServiceProviderScheduleRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('service_provider_schedule_edit');
    }

    public function rules()
    {
        return [
            'day_of_week' => [
                'string',
                'min:1',
                'max:7',
                'required',
            ],
            'start_time' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'end_time' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
        ];
    }
}
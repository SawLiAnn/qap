<?php

namespace App\Http\Requests;

use App\Models\ServiceProviderSchedule;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyServiceProviderScheduleRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('service_provider_schedule_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:service_provider_schedules,id',
        ];
    }
}
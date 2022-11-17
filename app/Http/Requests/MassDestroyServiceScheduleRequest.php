<?php

namespace App\Http\Requests;

use App\Models\ServiceSchedule;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyServiceScheduleRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('service_schedule_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:service_schedules,id',
        ];
    }
}
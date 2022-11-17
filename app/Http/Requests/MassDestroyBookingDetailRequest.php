<?php

namespace App\Http\Requests;

use App\Models\BookingDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBookingDetailRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('booking_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:booking_details,id',
        ];
    }
}
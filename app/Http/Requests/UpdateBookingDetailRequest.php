<?php

namespace App\Http\Requests;

use App\Models\BookingDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBookingDetailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('booking_detail_edit');
    }

    public function rules()
    {
        return [
            'booking_no' => [
                'string',
                'required',
            ],
            'booking_date_time' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'service_id' => [
                'required',
                'integer',
            ],
            'client_id' => [
                'required',
                'integer',
            ],
            'status' => [
                'string',
                'required',
            ],
        ];
    }
}
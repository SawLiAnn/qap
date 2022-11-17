<?php

namespace App\Http\Requests;

use App\Models\PaymentTransaction;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePaymentTransactionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('payment_transaction_edit');
    }

    public function rules()
    {
        return [
            'invoice_no' => [
                'string',
                'required',
            ],
            'date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'booking_details_id' => [
                'required',
                'integer',
            ],
            'client_id' => [
                'required',
                'integer',
            ],
            'paid_with' => [
                'string',
                'required',
            ],
            'amount' => [
                'string',
                'required',
            ],
        ];
    }
}
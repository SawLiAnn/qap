<?php

namespace App\Http\Requests;

use App\Models\PaymentTransaction;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPaymentTransactionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('payment_transaction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:payment_transactions,id',
        ];
    }
}
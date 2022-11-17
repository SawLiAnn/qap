<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPaymentTransactionRequest;
use App\Http\Requests\StorePaymentTransactionRequest;
use App\Http\Requests\UpdatePaymentTransactionRequest;
use App\Models\BookingDetail;
use App\Models\Client;
use App\Models\PaymentTransaction;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentTransactionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('payment_transaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentTransactions = PaymentTransaction::with(['booking_details', 'client', 'team'])->get();

        return view('admin.paymentTransactions.index', compact('paymentTransactions'));
    }

    public function create()
    {
        abort_if(Gate::denies('payment_transaction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $booking_details = BookingDetail::pluck('booking_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.paymentTransactions.create', compact('booking_details', 'clients'));
    }

    public function store(StorePaymentTransactionRequest $request)
    {
        $paymentTransaction = PaymentTransaction::create($request->all());

        return redirect()->route('admin.payment-transactions.index');
    }

    public function edit(PaymentTransaction $paymentTransaction)
    {
        abort_if(Gate::denies('payment_transaction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $booking_details = BookingDetail::pluck('booking_no', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $paymentTransaction->load('booking_details', 'client', 'team');

        return view('admin.paymentTransactions.edit', compact('booking_details', 'clients', 'paymentTransaction'));
    }

    public function update(UpdatePaymentTransactionRequest $request, PaymentTransaction $paymentTransaction)
    {
        $paymentTransaction->update($request->all());

        return redirect()->route('admin.payment-transactions.index');
    }

    public function show(PaymentTransaction $paymentTransaction)
    {
        abort_if(Gate::denies('payment_transaction_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentTransaction->load('booking_details', 'client', 'team');

        return view('admin.paymentTransactions.show', compact('paymentTransaction'));
    }

    public function destroy(PaymentTransaction $paymentTransaction)
    {
        abort_if(Gate::denies('payment_transaction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $paymentTransaction->delete();

        return back();
    }

    public function massDestroy(MassDestroyPaymentTransactionRequest $request)
    {
        PaymentTransaction::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
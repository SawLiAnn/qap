@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.paymentTransaction.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.payment-transactions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentTransaction.fields.id') }}
                        </th>
                        <td>
                            {{ $paymentTransaction->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentTransaction.fields.invoice_no') }}
                        </th>
                        <td>
                            {{ $paymentTransaction->invoice_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentTransaction.fields.date') }}
                        </th>
                        <td>
                            {{ $paymentTransaction->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentTransaction.fields.booking_details') }}
                        </th>
                        <td>
                            {{ $paymentTransaction->booking_details->booking_no ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentTransaction.fields.client') }}
                        </th>
                        <td>
                            {{ $paymentTransaction->client->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentTransaction.fields.paid_with') }}
                        </th>
                        <td>
                            {{ $paymentTransaction->paid_with }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.paymentTransaction.fields.amount') }}
                        </th>
                        <td>
                            {{ $paymentTransaction->amount }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.payment-transactions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
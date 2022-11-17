@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.paymentTransaction.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.payment-transactions.update', [$paymentTransaction->id]) }}"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="invoice_no">{{ trans('cruds.paymentTransaction.fields.invoice_no')
                    }}</label>
                <input class="form-control {{ $errors->has('invoice_no') ? 'is-invalid' : '' }}" type="text"
                    name="invoice_no" id="invoice_no" value="{{ old('invoice_no', $paymentTransaction->invoice_no) }}"
                    required>
                @if($errors->has('invoice_no'))
                <div class="invalid-feedback">
                    {{ $errors->first('invoice_no') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentTransaction.fields.invoice_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.paymentTransaction.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date"
                    id="date" value="{{ old('date', $paymentTransaction->date) }}" required>
                @if($errors->has('date'))
                <div class="invalid-feedback">
                    {{ $errors->first('date') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentTransaction.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="booking_details_id">{{
                    trans('cruds.paymentTransaction.fields.booking_details') }}</label>
                <select class="form-control select2 {{ $errors->has('booking_details') ? 'is-invalid' : '' }}"
                    name="booking_details_id" id="booking_details_id" required>
                    @foreach($booking_details as $id => $entry)
                    <option value="{{ $id }}" {{ (old('booking_details_id') ? old('booking_details_id') :
                        $paymentTransaction->booking_details->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('booking_details'))
                <div class="invalid-feedback">
                    {{ $errors->first('booking_details') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentTransaction.fields.booking_details_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="client_id">{{ trans('cruds.paymentTransaction.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id"
                    id="client_id" required>
                    @foreach($clients as $id => $entry)
                    <option value="{{ $id }}" {{ (old('client_id') ? old('client_id') : $paymentTransaction->client->id
                        ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                <div class="invalid-feedback">
                    {{ $errors->first('client') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentTransaction.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="paid_with">{{ trans('cruds.paymentTransaction.fields.paid_with') }}</label>
                <input class="form-control {{ $errors->has('paid_with') ? 'is-invalid' : '' }}" type="text"
                    name="paid_with" id="paid_with" value="{{ old('paid_with', $paymentTransaction->paid_with) }}"
                    required>
                @if($errors->has('paid_with'))
                <div class="invalid-feedback">
                    {{ $errors->first('paid_with') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentTransaction.fields.paid_with_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="amount">{{ trans('cruds.paymentTransaction.fields.amount') }}</label>
                <input class="form-control {{ $errors->has('amount') ? 'is-invalid' : '' }}" type="text" name="amount"
                    id="amount" value="{{ old('amount', $paymentTransaction->amount) }}" required>
                @if($errors->has('amount'))
                <div class="invalid-feedback">
                    {{ $errors->first('amount') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentTransaction.fields.amount_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.bookingDetail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.booking-details.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="booking_no">{{ trans('cruds.bookingDetail.fields.booking_no') }}</label>
                <input class="form-control {{ $errors->has('booking_no') ? 'is-invalid' : '' }}" type="text"
                    name="booking_no" id="booking_no" value="{{ old('booking_no', '') }}" required>
                @if($errors->has('booking_no'))
                <div class="invalid-feedback">
                    {{ $errors->first('booking_no') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.bookingDetail.fields.booking_no_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="booking_date_time">{{ trans('cruds.bookingDetail.fields.booking_date_time')
                    }}</label>
                <input class="form-control datetime {{ $errors->has('booking_date_time') ? 'is-invalid' : '' }}"
                    type="text" name="booking_date_time" id="booking_date_time" value="{{ old('booking_date_time') }}"
                    required>
                @if($errors->has('booking_date_time'))
                <div class="invalid-feedback">
                    {{ $errors->first('booking_date_time') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.bookingDetail.fields.booking_date_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="service_id">{{ trans('cruds.bookingDetail.fields.service') }}</label>
                <select class="form-control select2 {{ $errors->has('service') ? 'is-invalid' : '' }}" name="service_id"
                    id="service_id" required>
                    @foreach($services as $id => $entry)
                    <option value="{{ $id }}" {{ old('service_id')==$id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('service'))
                <div class="invalid-feedback">
                    {{ $errors->first('service') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.bookingDetail.fields.service_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="service_provider_id">{{ trans('cruds.bookingDetail.fields.service_provider') }}</label>
                <select class="form-control select2 {{ $errors->has('service_provider') ? 'is-invalid' : '' }}"
                    name="service_provider_id" id="service_provider_id">
                    @foreach($service_providers as $id => $entry)
                    <option value="{{ $id }}" {{ old('service_provider_id')==$id ? 'selected' : '' }}>{{ $entry }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('service_provider'))
                <div class="invalid-feedback">
                    {{ $errors->first('service_provider') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.bookingDetail.fields.service_provider_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="client_id">{{ trans('cruds.bookingDetail.fields.client') }}</label>
                <select class="form-control select2 {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client_id"
                    id="client_id" required>
                    @foreach($clients as $id => $entry)
                    <option value="{{ $id }}" {{ old('client_id')==$id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('client'))
                <div class="invalid-feedback">
                    {{ $errors->first('client') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.bookingDetail.fields.client_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="status">{{ trans('cruds.bookingDetail.fields.status') }}</label>
                <input class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" type="text" name="status"
                    id="status" value="{{ old('status', '') }}" required>
                @if($errors->has('status'))
                <div class="invalid-feedback">
                    {{ $errors->first('status') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.bookingDetail.fields.status_helper') }}</span>
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
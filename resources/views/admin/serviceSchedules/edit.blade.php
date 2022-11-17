@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.serviceSchedule.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.service-schedules.update', [$serviceSchedule->id]) }}"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="day_of_week">{{ trans('cruds.serviceSchedule.fields.day_of_week')
                    }}</label>
                <input class="form-control {{ $errors->has('day_of_week') ? 'is-invalid' : '' }}" type="text"
                    name="day_of_week" id="day_of_week" value="{{ old('day_of_week', $serviceSchedule->day_of_week) }}"
                    required>
                @if($errors->has('day_of_week'))
                <div class="invalid-feedback">
                    {{ $errors->first('day_of_week') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.serviceSchedule.fields.day_of_week_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_time">{{ trans('cruds.serviceSchedule.fields.start_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="text"
                    name="start_time" id="start_time" value="{{ old('start_time', $serviceSchedule->start_time) }}"
                    required>
                @if($errors->has('start_time'))
                <div class="invalid-feedback">
                    {{ $errors->first('start_time') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.serviceSchedule.fields.start_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="end_time">{{ trans('cruds.serviceSchedule.fields.end_time') }}</label>
                <input class="form-control timepicker {{ $errors->has('end_time') ? 'is-invalid' : '' }}" type="text"
                    name="end_time" id="end_time" value="{{ old('end_time', $serviceSchedule->end_time) }}" required>
                @if($errors->has('end_time'))
                <div class="invalid-feedback">
                    {{ $errors->first('end_time') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.serviceSchedule.fields.end_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="service_id">{{ trans('cruds.serviceSchedule.fields.service') }}</label>
                <select class="form-control select2 {{ $errors->has('service') ? 'is-invalid' : '' }}" name="service_id"
                    id="service_id">
                    @foreach($services as $id => $entry)
                    <option value="{{ $id }}" {{ (old('service_id') ? old('service_id') : $serviceSchedule->service->id
                        ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('service'))
                <div class="invalid-feedback">
                    {{ $errors->first('service') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.serviceSchedule.fields.service_helper') }}</span>
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
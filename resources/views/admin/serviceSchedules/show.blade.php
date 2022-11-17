@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.serviceSchedule.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.service-schedules.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.serviceSchedule.fields.id') }}
                        </th>
                        <td>
                            {{ $serviceSchedule->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.serviceSchedule.fields.day_of_week') }}
                        </th>
                        <td>
                            {{ $serviceSchedule->day_of_week }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.serviceSchedule.fields.start_time') }}
                        </th>
                        <td>
                            {{ $serviceSchedule->start_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.serviceSchedule.fields.end_time') }}
                        </th>
                        <td>
                            {{ $serviceSchedule->end_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.serviceSchedule.fields.service') }}
                        </th>
                        <td>
                            {{ $serviceSchedule->service->service_name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.service-schedules.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
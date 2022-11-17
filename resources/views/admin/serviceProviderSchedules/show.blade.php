@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.serviceProviderSchedule.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.service-provider-schedules.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.serviceProviderSchedule.fields.id') }}
                        </th>
                        <td>
                            {{ $serviceProviderSchedule->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.serviceProviderSchedule.fields.day_of_week') }}
                        </th>
                        <td>
                            {{ $serviceProviderSchedule->day_of_week }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.serviceProviderSchedule.fields.start_time') }}
                        </th>
                        <td>
                            {{ $serviceProviderSchedule->start_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.serviceProviderSchedule.fields.end_time') }}
                        </th>
                        <td>
                            {{ $serviceProviderSchedule->end_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.serviceProviderSchedule.fields.service_provider') }}
                        </th>
                        <td>
                            {{ $serviceProviderSchedule->service_provider->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.service-provider-schedules.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
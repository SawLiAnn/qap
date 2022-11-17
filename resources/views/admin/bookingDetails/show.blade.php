@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bookingDetail.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.booking-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bookingDetail.fields.id') }}
                        </th>
                        <td>
                            {{ $bookingDetail->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bookingDetail.fields.booking_no') }}
                        </th>
                        <td>
                            {{ $bookingDetail->booking_no }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bookingDetail.fields.booking_date_time') }}
                        </th>
                        <td>
                            {{ $bookingDetail->booking_date_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bookingDetail.fields.service') }}
                        </th>
                        <td>
                            {{ $bookingDetail->service->service_name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bookingDetail.fields.service_provider') }}
                        </th>
                        <td>
                            {{ $bookingDetail->service_provider->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bookingDetail.fields.client') }}
                        </th>
                        <td>
                            {{ $bookingDetail->client->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bookingDetail.fields.status') }}
                        </th>
                        <td>
                            {{ $bookingDetail->status }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.booking-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
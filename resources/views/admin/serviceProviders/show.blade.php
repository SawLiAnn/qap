@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.serviceProvider.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.service-providers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.serviceProvider.fields.id') }}
                        </th>
                        <td>
                            {{ $serviceProvider->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.serviceProvider.fields.name') }}
                        </th>
                        <td>
                            {{ $serviceProvider->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.serviceProvider.fields.description') }}
                        </th>
                        <td>
                            {{ $serviceProvider->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.serviceProvider.fields.phone') }}
                        </th>
                        <td>
                            {{ $serviceProvider->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.serviceProvider.fields.email') }}
                        </th>
                        <td>
                            {{ $serviceProvider->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.serviceProvider.fields.image') }}
                        </th>
                        <td>
                            @if($serviceProvider->image)
                            <a href="{{ $serviceProvider->image->getUrl() }}" target="_blank"
                                style="display: inline-block">
                                <img src="{{ $serviceProvider->image->getUrl('thumb') }}">
                            </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.serviceProvider.fields.service') }}
                        </th>
                        <td>
                            @foreach($serviceProvider->services as $key => $service)
                            <span class="label label-info">{{ $service->service_name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.service-providers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
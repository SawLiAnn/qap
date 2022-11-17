@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.service.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.services.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.id') }}
                        </th>
                        <td>
                            {{ $service->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.service_name') }}
                        </th>
                        <td>
                            {{ $service->service_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.service_description') }}
                        </th>
                        <td>
                            {{ $service->service_description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.service_image') }}
                        </th>
                        <td>
                            @if($service->service_image)
                            <a href="{{ $service->service_image->getUrl() }}" target="_blank"
                                style="display: inline-block">
                                <img src="{{ $service->service_image->getUrl('thumb') }}">
                            </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.price') }}
                        </th>
                        <td>
                            {{ $service->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.duration') }}
                        </th>
                        <td>
                            {{ $service->duration }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.service.fields.service_provider') }}
                        </th>
                        <td>
                            @foreach($service->service_providers as $key => $service_provider)
                            <span class="label label-info">{{ $service_provider->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.services.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
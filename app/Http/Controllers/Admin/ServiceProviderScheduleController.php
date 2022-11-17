<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyServiceProviderScheduleRequest;
use App\Http\Requests\StoreServiceProviderScheduleRequest;
use App\Http\Requests\UpdateServiceProviderScheduleRequest;
use App\Models\ServiceProvider;
use App\Models\ServiceProviderSchedule;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ServiceProviderScheduleController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('service_provider_schedule_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $serviceProviderSchedules = ServiceProviderSchedule::with(['service_provider', 'team'])->get();

        return view('admin.serviceProviderSchedules.index', compact('serviceProviderSchedules'));
    }

    public function create()
    {
        abort_if(Gate::denies('service_provider_schedule_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $service_providers = ServiceProvider::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.serviceProviderSchedules.create', compact('service_providers'));
    }

    public function store(StoreServiceProviderScheduleRequest $request)
    {
        $serviceProviderSchedule = ServiceProviderSchedule::create($request->all());

        return redirect()->route('admin.service-provider-schedules.index');
    }

    public function edit(ServiceProviderSchedule $serviceProviderSchedule)
    {
        abort_if(Gate::denies('service_provider_schedule_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $service_providers = ServiceProvider::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $serviceProviderSchedule->load('service_provider', 'team');

        return view('admin.serviceProviderSchedules.edit', compact('serviceProviderSchedule', 'service_providers'));
    }

    public function update(UpdateServiceProviderScheduleRequest $request, ServiceProviderSchedule $serviceProviderSchedule)
    {
        $serviceProviderSchedule->update($request->all());

        return redirect()->route('admin.service-provider-schedules.index');
    }

    public function show(ServiceProviderSchedule $serviceProviderSchedule)
    {
        abort_if(Gate::denies('service_provider_schedule_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $serviceProviderSchedule->load('service_provider', 'team');

        return view('admin.serviceProviderSchedules.show', compact('serviceProviderSchedule'));
    }

    public function destroy(ServiceProviderSchedule $serviceProviderSchedule)
    {
        abort_if(Gate::denies('service_provider_schedule_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $serviceProviderSchedule->delete();

        return back();
    }

    public function massDestroy(MassDestroyServiceProviderScheduleRequest $request)
    {
        ServiceProviderSchedule::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
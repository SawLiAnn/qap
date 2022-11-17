<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyServiceScheduleRequest;
use App\Http\Requests\StoreServiceScheduleRequest;
use App\Http\Requests\UpdateServiceScheduleRequest;
use App\Models\Service;
use App\Models\ServiceSchedule;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ServiceScheduleController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('service_schedule_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $serviceSchedules = ServiceSchedule::with(['service', 'team'])->get();

        return view('admin.serviceSchedules.index', compact('serviceSchedules'));
    }

    public function create()
    {
        abort_if(Gate::denies('service_schedule_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $services = Service::pluck('service_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.serviceSchedules.create', compact('services'));
    }

    public function store(StoreServiceScheduleRequest $request)
    {
        $serviceSchedule = ServiceSchedule::create($request->all());

        return redirect()->route('admin.service-schedules.index');
    }

    public function edit(ServiceSchedule $serviceSchedule)
    {
        abort_if(Gate::denies('service_schedule_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $services = Service::pluck('service_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $serviceSchedule->load('service', 'team');

        return view('admin.serviceSchedules.edit', compact('serviceSchedule', 'services'));
    }

    public function update(UpdateServiceScheduleRequest $request, ServiceSchedule $serviceSchedule)
    {
        $serviceSchedule->update($request->all());

        return redirect()->route('admin.service-schedules.index');
    }

    public function show(ServiceSchedule $serviceSchedule)
    {
        abort_if(Gate::denies('service_schedule_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $serviceSchedule->load('service', 'team');

        return view('admin.serviceSchedules.show', compact('serviceSchedule'));
    }

    public function destroy(ServiceSchedule $serviceSchedule)
    {
        abort_if(Gate::denies('service_schedule_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $serviceSchedule->delete();

        return back();
    }

    public function massDestroy(MassDestroyServiceScheduleRequest $request)
    {
        ServiceSchedule::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
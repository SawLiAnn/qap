<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBookingDetailRequest;
use App\Http\Requests\StoreBookingDetailRequest;
use App\Http\Requests\UpdateBookingDetailRequest;
use App\Models\BookingDetail;
use App\Models\Client;
use App\Models\Service;
use App\Models\ServiceProvider;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookingDetailController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('booking_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookingDetails = BookingDetail::with(['service', 'service_provider', 'client', 'team'])->get();

        return view('admin.bookingDetails.index', compact('bookingDetails'));
    }

    public function create()
    {
        abort_if(Gate::denies('booking_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $services = Service::pluck('service_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $service_providers = ServiceProvider::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bookingDetails.create', compact('clients', 'service_providers', 'services'));
    }

    public function store(StoreBookingDetailRequest $request)
    {
        $bookingDetail = BookingDetail::create($request->all());

        return redirect()->route('admin.booking-details.index');
    }

    public function edit(BookingDetail $bookingDetail)
    {
        abort_if(Gate::denies('booking_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $services = Service::pluck('service_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $service_providers = ServiceProvider::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $clients = Client::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bookingDetail->load('service', 'service_provider', 'client', 'team');

        return view('admin.bookingDetails.edit', compact('bookingDetail', 'clients', 'service_providers', 'services'));
    }

    public function update(UpdateBookingDetailRequest $request, BookingDetail $bookingDetail)
    {
        $bookingDetail->update($request->all());

        return redirect()->route('admin.booking-details.index');
    }

    public function show(BookingDetail $bookingDetail)
    {
        abort_if(Gate::denies('booking_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookingDetail->load('service', 'service_provider', 'client', 'team');

        return view('admin.bookingDetails.show', compact('bookingDetail'));
    }

    public function destroy(BookingDetail $bookingDetail)
    {
        abort_if(Gate::denies('booking_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookingDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyBookingDetailRequest $request)
    {
        BookingDetail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyServiceProviderRequest;
use App\Http\Requests\StoreServiceProviderRequest;
use App\Http\Requests\UpdateServiceProviderRequest;
use App\Models\Service;
use App\Models\ServiceProvider;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ServiceProviderController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('service_provider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $serviceProviders = ServiceProvider::with(['services', 'team', 'media'])->get();

        return view('admin.serviceProviders.index', compact('serviceProviders'));
    }

    public function create()
    {
        abort_if(Gate::denies('service_provider_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $services = Service::pluck('service_name', 'id');

        return view('admin.serviceProviders.create', compact('services'));
    }

    public function store(StoreServiceProviderRequest $request)
    {
        $serviceProvider = ServiceProvider::create($request->all());
        $serviceProvider->services()->sync($request->input('services', []));
        if ($request->input('image', false)) {
            $serviceProvider->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $serviceProvider->id]);
        }

        return redirect()->route('admin.service-providers.index');
    }

    public function edit(ServiceProvider $serviceProvider)
    {
        abort_if(Gate::denies('service_provider_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $services = Service::pluck('service_name', 'id');

        $serviceProvider->load('services', 'team');

        return view('admin.serviceProviders.edit', compact('serviceProvider', 'services'));
    }

    public function update(UpdateServiceProviderRequest $request, ServiceProvider $serviceProvider)
    {
        $serviceProvider->update($request->all());
        $serviceProvider->services()->sync($request->input('services', []));
        if ($request->input('image', false)) {
            if (!$serviceProvider->image || $request->input('image') !== $serviceProvider->image->file_name) {
                if ($serviceProvider->image) {
                    $serviceProvider->image->delete();
                }
                $serviceProvider->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($serviceProvider->image) {
            $serviceProvider->image->delete();
        }

        return redirect()->route('admin.service-providers.index');
    }

    public function show(ServiceProvider $serviceProvider)
    {
        abort_if(Gate::denies('service_provider_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $serviceProvider->load('services', 'team');

        return view('admin.serviceProviders.show', compact('serviceProvider'));
    }

    public function destroy(ServiceProvider $serviceProvider)
    {
        abort_if(Gate::denies('service_provider_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $serviceProvider->delete();

        return back();
    }

    public function massDestroy(MassDestroyServiceProviderRequest $request)
    {
        ServiceProvider::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('service_provider_create') && Gate::denies('service_provider_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ServiceProvider();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
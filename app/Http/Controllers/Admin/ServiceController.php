<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyServiceRequest;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use App\Models\ServiceProvider;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('service_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $services = Service::with(['service_providers', 'team', 'media'])->get();

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        abort_if(Gate::denies('service_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $service_providers = ServiceProvider::pluck('name', 'id');

        return view('admin.services.create', compact('service_providers'));
    }

    public function store(StoreServiceRequest $request)
    {
        $service = Service::create($request->all());
        $service->service_providers()->sync($request->input('service_providers', []));
        if ($request->input('service_image', false)) {
            $service->addMedia(storage_path('tmp/uploads/' . basename($request->input('service_image'))))->toMediaCollection('service_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $service->id]);
        }

        return redirect()->route('admin.services.index');
    }

    public function edit(Service $service)
    {
        abort_if(Gate::denies('service_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $service_providers = ServiceProvider::pluck('name', 'id');

        $service->load('service_providers', 'team');

        return view('admin.services.edit', compact('service', 'service_providers'));
    }

    public function update(UpdateServiceRequest $request, Service $service)
    {
        $service->update($request->all());
        $service->service_providers()->sync($request->input('service_providers', []));
        if ($request->input('service_image', false)) {
            if (!$service->service_image || $request->input('service_image') !== $service->service_image->file_name) {
                if ($service->service_image) {
                    $service->service_image->delete();
                }
                $service->addMedia(storage_path('tmp/uploads/' . basename($request->input('service_image'))))->toMediaCollection('service_image');
            }
        } elseif ($service->service_image) {
            $service->service_image->delete();
        }

        return redirect()->route('admin.services.index');
    }

    public function show(Service $service)
    {
        abort_if(Gate::denies('service_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $service->load('service_providers', 'team');

        return view('admin.services.show', compact('service'));
    }

    public function destroy(Service $service)
    {
        abort_if(Gate::denies('service_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $service->delete();

        return back();
    }

    public function massDestroy(MassDestroyServiceRequest $request)
    {
        Service::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('service_create') && Gate::denies('service_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Service();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

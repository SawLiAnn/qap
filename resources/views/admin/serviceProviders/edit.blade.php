@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.serviceProvider.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.service-providers.update', [$serviceProvider->id]) }}"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.serviceProvider.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                    id="name" value="{{ old('name', $serviceProvider->name) }}" required>
                @if($errors->has('name'))
                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.serviceProvider.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.serviceProvider.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text"
                    name="description" id="description" value="{{ old('description', $serviceProvider->description) }}">
                @if($errors->has('description'))
                <div class="invalid-feedback">
                    {{ $errors->first('description') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.serviceProvider.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.serviceProvider.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone"
                    id="phone" value="{{ old('phone', $serviceProvider->phone) }}">
                @if($errors->has('phone'))
                <div class="invalid-feedback">
                    {{ $errors->first('phone') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.serviceProvider.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.serviceProvider.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                    id="email" value="{{ old('email', $serviceProvider->email) }}">
                @if($errors->has('email'))
                <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.serviceProvider.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="image">{{ trans('cruds.serviceProvider.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                <div class="invalid-feedback">
                    {{ $errors->first('image') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.serviceProvider.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="services">{{ trans('cruds.serviceProvider.fields.service') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all')
                        }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{
                        trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('services') ? 'is-invalid' : '' }}"
                    name="services[]" id="services" multiple>
                    @foreach($services as $id => $service)
                    <option value="{{ $id }}" {{ (in_array($id, old('services', [])) || $serviceProvider->
                        services->contains($id)) ? 'selected' : '' }}>{{ $service }}</option>
                    @endforeach
                </select>
                @if($errors->has('services'))
                <div class="invalid-feedback">
                    {{ $errors->first('services') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.serviceProvider.fields.service_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.service-providers.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($serviceProvider) && $serviceProvider->image)
      var file = {!! json_encode($serviceProvider->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}

</script>
@endsection
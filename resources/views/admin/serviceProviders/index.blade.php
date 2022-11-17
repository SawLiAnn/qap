@extends('layouts.admin')
@section('content')
@can('service_provider_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.service-providers.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.serviceProvider.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.serviceProvider.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ServiceProvider">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.serviceProvider.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.serviceProvider.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.serviceProvider.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.serviceProvider.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.serviceProvider.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.serviceProvider.fields.image') }}
                        </th>
                        <th>
                            {{ trans('cruds.serviceProvider.fields.service') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($serviceProviders as $key => $serviceProvider)
                    <tr data-entry-id="{{ $serviceProvider->id }}">
                        <td>

                        </td>
                        <td>
                            {{ $serviceProvider->id ?? '' }}
                        </td>
                        <td>
                            {{ $serviceProvider->name ?? '' }}
                        </td>
                        <td>
                            {{ $serviceProvider->description ?? '' }}
                        </td>
                        <td>
                            {{ $serviceProvider->phone ?? '' }}
                        </td>
                        <td>
                            {{ $serviceProvider->email ?? '' }}
                        </td>
                        <td>
                            @if($serviceProvider->image)
                            <a href="{{ $serviceProvider->image->getUrl() }}" target="_blank"
                                style="display: inline-block">
                                <img src="{{ $serviceProvider->image->getUrl('thumb') }}">
                            </a>
                            @endif
                        </td>
                        <td>
                            @foreach($serviceProvider->services as $key => $item)
                            <span class="badge badge-info">{{ $item->service_name }}</span>
                            @endforeach
                        </td>
                        <td>
                            @can('service_provider_show')
                            <a class="btn btn-xs btn-primary"
                                href="{{ route('admin.service-providers.show', $serviceProvider->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan

                            @can('service_provider_edit')
                            <a class="btn btn-xs btn-info"
                                href="{{ route('admin.service-providers.edit', $serviceProvider->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan

                            @can('service_provider_delete')
                            <form action="{{ route('admin.service-providers.destroy', $serviceProvider->id) }}"
                                method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                            </form>
                            @endcan

                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('service_provider_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.service-providers.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-ServiceProvider:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
@extends('layouts.admin')
@section('content')
@can('service_provider_schedule_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.service-provider-schedules.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.serviceProviderSchedule.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.serviceProviderSchedule.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ServiceProviderSchedule">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.serviceProviderSchedule.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.serviceProviderSchedule.fields.day_of_week') }}
                        </th>
                        <th>
                            {{ trans('cruds.serviceProviderSchedule.fields.start_time') }}
                        </th>
                        <th>
                            {{ trans('cruds.serviceProviderSchedule.fields.end_time') }}
                        </th>
                        <th>
                            {{ trans('cruds.serviceProviderSchedule.fields.service_provider') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($serviceProviderSchedules as $key => $serviceProviderSchedule)
                    <tr data-entry-id="{{ $serviceProviderSchedule->id }}">
                        <td>

                        </td>
                        <td>
                            {{ $serviceProviderSchedule->id ?? '' }}
                        </td>
                        <td>
                            {{ $serviceProviderSchedule->day_of_week ?? '' }}
                        </td>
                        <td>
                            {{ $serviceProviderSchedule->start_time ?? '' }}
                        </td>
                        <td>
                            {{ $serviceProviderSchedule->end_time ?? '' }}
                        </td>
                        <td>
                            {{ $serviceProviderSchedule->service_provider->name ?? '' }}
                        </td>
                        <td>
                            @can('service_provider_schedule_show')
                            <a class="btn btn-xs btn-primary"
                                href="{{ route('admin.service-provider-schedules.show', $serviceProviderSchedule->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan

                            @can('service_provider_schedule_edit')
                            <a class="btn btn-xs btn-info"
                                href="{{ route('admin.service-provider-schedules.edit', $serviceProviderSchedule->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan

                            @can('service_provider_schedule_delete')
                            <form
                                action="{{ route('admin.service-provider-schedules.destroy', $serviceProviderSchedule->id) }}"
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
@can('service_provider_schedule_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.service-provider-schedules.massDestroy') }}",
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
  let table = $('.datatable-ServiceProviderSchedule:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
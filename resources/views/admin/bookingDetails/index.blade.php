@extends('layouts.admin')
@section('content')
@can('booking_detail_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.booking-details.create') }}">
            {{ trans('global.add') }} {{ trans('cruds.bookingDetail.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.bookingDetail.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-BookingDetail">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.bookingDetail.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.bookingDetail.fields.booking_no') }}
                        </th>
                        <th>
                            {{ trans('cruds.bookingDetail.fields.booking_date_time') }}
                        </th>
                        <th>
                            {{ trans('cruds.bookingDetail.fields.service') }}
                        </th>
                        <th>
                            {{ trans('cruds.service.fields.service_description') }}
                        </th>
                        <th>
                            {{ trans('cruds.bookingDetail.fields.service_provider') }}
                        </th>
                        <th>
                            {{ trans('cruds.bookingDetail.fields.client') }}
                        </th>
                        <th>
                            {{ trans('cruds.bookingDetail.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookingDetails as $key => $bookingDetail)
                    <tr data-entry-id="{{ $bookingDetail->id }}">
                        <td>

                        </td>
                        <td>
                            {{ $bookingDetail->id ?? '' }}
                        </td>
                        <td>
                            {{ $bookingDetail->booking_no ?? '' }}
                        </td>
                        <td>
                            {{ $bookingDetail->booking_date_time ?? '' }}
                        </td>
                        <td>
                            {{ $bookingDetail->service->service_name ?? '' }}
                        </td>
                        <td>
                            {{ $bookingDetail->service->service_description ?? '' }}
                        </td>
                        <td>
                            {{ $bookingDetail->service_provider->name ?? '' }}
                        </td>
                        <td>
                            {{ $bookingDetail->client->name ?? '' }}
                        </td>
                        <td>
                            {{ $bookingDetail->status ?? '' }}
                        </td>
                        <td>
                            @can('booking_detail_show')
                            <a class="btn btn-xs btn-primary"
                                href="{{ route('admin.booking-details.show', $bookingDetail->id) }}">
                                {{ trans('global.view') }}
                            </a>
                            @endcan

                            @can('booking_detail_edit')
                            <a class="btn btn-xs btn-info"
                                href="{{ route('admin.booking-details.edit', $bookingDetail->id) }}">
                                {{ trans('global.edit') }}
                            </a>
                            @endcan

                            @can('booking_detail_delete')
                            <form action="{{ route('admin.booking-details.destroy', $bookingDetail->id) }}"
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
@can('booking_detail_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.booking-details.massDestroy') }}",
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
  let table = $('.datatable-BookingDetail:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
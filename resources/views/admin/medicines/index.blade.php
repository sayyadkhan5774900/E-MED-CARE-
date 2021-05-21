@extends('layouts.admin')
@section('content')
@can('medicine_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.medicines.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.medicine.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.medicine.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Medicine">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.medicine.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.medicine.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.medicine.fields.description') }}
                        </th>
                        <th>
                            {{ trans('cruds.medicine.fields.price') }}
                        </th>
                        <th>
                            {{ trans('cruds.medicine.fields.in_stock') }}
                        </th>
                        <th>
                            {{ trans('cruds.medicine.fields.image') }}
                        </th>
                        <th>
                            {{ trans('cruds.medicine.fields.expiry_date') }}
                        </th>
                        <th>
                            {{ trans('cruds.medicine.fields.category') }}
                        </th>
                        <th>
                            {{ trans('cruds.medicine.fields.pharmacy') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($medicines as $key => $medicine)
                        <tr data-entry-id="{{ $medicine->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $medicine->id ?? '' }}
                            </td>
                            <td>
                                {{ $medicine->name ?? '' }}
                            </td>
                            <td>
                                {{ $medicine->description ?? '' }}
                            </td>
                            <td>
                                {{ $medicine->price ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $medicine->in_stock ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $medicine->in_stock ? 'checked' : '' }}>
                            </td>
                            <td>
                                @if($medicine->image)
                                    <a href="{{ $medicine->image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $medicine->image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $medicine->expiry_date ?? '' }}
                            </td>
                            <td>
                                {{ $medicine->category->name ?? '' }}
                            </td>
                            <td>
                                {{ $medicine->pharmacy->name ?? '' }}
                            </td>
                            <td>
                                @can('medicine_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.medicines.show', $medicine->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('medicine_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.medicines.edit', $medicine->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('medicine_delete')
                                    <form action="{{ route('admin.medicines.destroy', $medicine->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('medicine_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.medicines.massDestroy') }}",
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
  let table = $('.datatable-Medicine:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  $('div#sidebar').on('transitionend', function(e) {
    $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
  })
  
})

</script>
@endsection
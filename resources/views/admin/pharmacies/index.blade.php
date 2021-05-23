@extends('layouts.admin')
@section('content')
@can('pharmacy_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.pharmacies.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.pharmacy.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.pharmacy.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered  table-hover datatable datatable-Pharmacy">
                <thead class="table-heade">

                    <tr>
                        <th>
                            {{ trans('cruds.pharmacy.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.pharmacy.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.pharmacy.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.pharmacy.fields.address') }}
                        </th>
                        <th>
                            {{ trans('cruds.pharmacy.fields.owner') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pharmacies as $key => $pharmacy)
                        <tr data-entry-id="{{ $pharmacy->id }}">
                            <td>
                                {{ $pharmacy->id ?? '' }}
                            </td>
                            <td>
                                {{ $pharmacy->name ?? '' }}
                            </td>
                            <td>
                                {{ $pharmacy->phone ?? '' }}
                            </td>
                            <td>
                                {{ $pharmacy->address ?? '' }}
                            </td>
                            <td>
                                {{ $pharmacy->owner->name ?? '' }}
                            </td>
                            <td>
                                @can('pharmacy_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.pharmacies.show', $pharmacy->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('pharmacy_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.pharmacies.edit', $pharmacy->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('pharmacy_delete')
                                    <form action="{{ route('admin.pharmacies.destroy', $pharmacy->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 2, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-Pharmacy:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
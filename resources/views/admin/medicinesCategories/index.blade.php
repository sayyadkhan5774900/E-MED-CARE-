@extends('layouts.admin')
@section('content')
@can('medicines_category_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.medicines-categories.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.medicinesCategory.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.medicinesCategory.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-MedicinesCategory">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.medicinesCategory.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.medicinesCategory.fields.parent_category') }}
                        </th>
                        <th>
                            {{ trans('cruds.medicinesCategory.fields.name') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($medicinesCategories as $key => $medicinesCategory)
                        <tr data-entry-id="{{ $medicinesCategory->id }}">
                            <td>
                                {{ $medicinesCategory->id ?? '' }}
                            </td>
                            <td>
                                {{ $medicinesCategory->parent_category->name ?? '' }}
                            </td>
                            <td>
                                {{ $medicinesCategory->name ?? '' }}
                            </td>
                            <td>
                                @can('medicines_category_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.medicines-categories.show', $medicinesCategory->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('medicines_category_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.medicines-categories.edit', $medicinesCategory->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('medicines_category_delete')
                                    <form action="{{ route('admin.medicines-categories.destroy', $medicinesCategory->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
  let table = $('.datatable-MedicinesCategory:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
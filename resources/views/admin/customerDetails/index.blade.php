@extends('layouts.admin')
@section('content')
@can('customer_detail_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.customer-details.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.customerDetail.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.customerDetail.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered  table-hover datatable datatable-CustomerDetail">
                <thead class="table-heade">

                    <tr>
                        <th>
                            {{ trans('cruds.customerDetail.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.customerDetail.fields.customer') }}
                        </th>
                        <th>
                            {{ trans('cruds.customerDetail.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.customerDetail.fields.address') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customerDetails as $key => $customerDetail)
                        <tr data-entry-id="{{ $customerDetail->id }}">
                            <td>
                                {{ $customerDetail->id ?? '' }}
                            </td>
                            <td>
                                {{ $customerDetail->customer->name ?? '' }}
                            </td>
                            <td>
                                {{ $customerDetail->phone ?? '' }}
                            </td>
                            <td>
                                {{ $customerDetail->address ?? '' }}
                            </td>
                            <td>
                                @can('customer_detail_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.customer-details.show', $customerDetail->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('customer_detail_delete')
                                    <form action="{{ route('admin.customer-details.destroy', $customerDetail->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    pageLength: 50,
  });
  let table = $('.datatable-CustomerDetail:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.order.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered  table-hover datatable datatable-Order">
                <thead class="table-heade">

                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.pharmacy') }}
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.customer') }}
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            {{ trans('cruds.order.fields.status') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $key => $order)
                        <tr data-entry-id="{{ $order->id }}">
                            <td>
                                {{ $order->id ?? '' }}
                            </td>
                            <td>
                                {{ $order->pharmacy->name ?? '' }}
                            </td>
                            <td>
                                {{ $order->customer->name ?? '' }}
                            </td>
                            <td>
                                {{ $order->customer->email ?? '' }}
                            </td>
                            <td>
                                <form class="d-flex align-content-around justify-content-around" action="{{ route('admin.status.update', $order->id) }}" method="POST"  style="display: inline-block;">
                                    <div>
                                        <input type="hidden" name="_method" value="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id='{{ $order->id }}'>
                                            <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                            @foreach(App\Models\Order::STATUS_SELECT as $key => $label)
                                                <option value="{{ $key }}" {{ old('status', $order->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <input type="submit" class="btn btn-xs btn-success mt-1" value="{{ trans('global.update') }}">
                                    </div>
                                </form>
                                {{-- {{ App\Models\Order::STATUS_SELECT[$order->status] ?? '' }} --}}
                            </td>
                            <td>
                                @can('pharmacy_order_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.pharmacy-orders.show', $order->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
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
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-Order:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
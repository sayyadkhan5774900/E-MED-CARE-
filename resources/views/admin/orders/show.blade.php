@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.order.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.orders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered ">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.id') }}
                        </th>
                        <td>
                            {{ $order->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.pharmacy') }}
                        </th>
                        <td>
                            {{ $order->pharmacy->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.customer') }}
                        </th>
                        <td>
                            {{ $order->customer->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.order.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Order::STATUS_SELECT[$order->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Province
                        </th>
                        <td>
                            {{ $customer_details->province }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            City
                        </th>
                        <td>
                            {{ $customer_details->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Address
                        </th>
                        <td>
                            {{ $customer_details->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Phone
                        </th>
                        <td>
                            {{ $customer_details->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Email
                        </th>
                        <td>
                            {{ $order->customer->email ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="table-responsive">
                <table class=" table table-bordered">
                    <thead class="table-heade">
                        <tr>
                            <th>
                                id
                            </th>
                            <th>
                                name
                            </th>
                            <th>
                                quantity
                            </th>
                            <th>
                                sub-total
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($medicines as $key => $medicine)
                            <tr>
                                <td>
                                    {{ $medicine->id ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Medicine::find($medicine->medicine_id)->name ?? ''}}
                                </td>
                                <td>
                                    {{ $medicine->quantity ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Medicine::find($medicine->medicine_id)->price *  $medicine->quantity }}
                                </td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mx-2 mb-3 d-flex align-content-between justify-content-between">
                <div>
                    <b>Total</b>
                </div>
                <div>
                    {{ $total = null }}
                    @foreach ($medicines as $medicine)
                        <div class="d-none">
                            {{ $total = $total + ( App\Models\Medicine::find($medicine->medicine_id)->price *  $medicine->quantity) }}
                        </div>
                    @endforeach
                    <b>{{ $total }}</b>
                </div>
            </div>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.orders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection

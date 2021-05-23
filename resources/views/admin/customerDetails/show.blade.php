@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.customerDetail.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.customer-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered ">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.customerDetail.fields.id') }}
                        </th>
                        <td>
                            {{ $customerDetail->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerDetail.fields.province') }}
                        </th>
                        <td>
                            {{ $customerDetail->province }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerDetail.fields.city') }}
                        </th>
                        <td>
                            {{ $customerDetail->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerDetail.fields.phone') }}
                        </th>
                        <td>
                            {{ $customerDetail->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerDetail.fields.address') }}
                        </th>
                        <td>
                            {{ $customerDetail->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.customerDetail.fields.customer') }}
                        </th>
                        <td>
                            {{ $customerDetail->customer->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.customer-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
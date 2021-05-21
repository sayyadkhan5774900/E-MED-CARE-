@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pharmacy.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pharmacies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pharmacy.fields.id') }}
                        </th>
                        <td>
                            {{ $pharmacy->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pharmacy.fields.name') }}
                        </th>
                        <td>
                            {{ $pharmacy->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pharmacy.fields.description') }}
                        </th>
                        <td>
                            {{ $pharmacy->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pharmacy.fields.phone') }}
                        </th>
                        <td>
                            {{ $pharmacy->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pharmacy.fields.address') }}
                        </th>
                        <td>
                            {{ $pharmacy->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pharmacy.fields.opening_time') }}
                        </th>
                        <td>
                            {{ $pharmacy->opening_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pharmacy.fields.closing_time') }}
                        </th>
                        <td>
                            {{ $pharmacy->closing_time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pharmacy.fields.longitude') }}
                        </th>
                        <td>
                            {{ $pharmacy->longitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pharmacy.fields.latitude') }}
                        </th>
                        <td>
                            {{ $pharmacy->latitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pharmacy.fields.owner') }}
                        </th>
                        <td>
                            {{ $pharmacy->owner->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pharmacies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#pharmacy_medicines" role="tab" data-toggle="tab">
                {{ trans('cruds.medicine.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="pharmacy_medicines">
            @includeIf('admin.pharmacies.relationships.pharmacyMedicines', ['medicines' => $pharmacy->pharmacyMedicines])
        </div>
    </div>
</div>

@endsection
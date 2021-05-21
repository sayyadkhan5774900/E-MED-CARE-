@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.medicine.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.medicines.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.medicine.fields.id') }}
                        </th>
                        <td>
                            {{ $medicine->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicine.fields.name') }}
                        </th>
                        <td>
                            {{ $medicine->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicine.fields.description') }}
                        </th>
                        <td>
                            {{ $medicine->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicine.fields.price') }}
                        </th>
                        <td>
                            {{ $medicine->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicine.fields.in_stock') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $medicine->in_stock ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicine.fields.image') }}
                        </th>
                        <td>
                            @if($medicine->image)
                                <a href="{{ $medicine->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $medicine->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicine.fields.expiry_date') }}
                        </th>
                        <td>
                            {{ $medicine->expiry_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicine.fields.category') }}
                        </th>
                        <td>
                            {{ $medicine->category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicine.fields.pharmacy') }}
                        </th>
                        <td>
                            {{ $medicine->pharmacy->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.medicines.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
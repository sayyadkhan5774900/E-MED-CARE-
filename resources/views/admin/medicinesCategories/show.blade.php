@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.medicinesCategory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.medicines-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered ">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.medicinesCategory.fields.id') }}
                        </th>
                        <td>
                            {{ $medicinesCategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicinesCategory.fields.parent_category') }}
                        </th>
                        <td>
                            {{ $medicinesCategory->parent_category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicinesCategory.fields.name') }}
                        </th>
                        <td>
                            {{ $medicinesCategory->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicinesCategory.fields.image') }}
                        </th>
                        <td>
                            @if($medicinesCategory->image)
                                <a href="{{ $medicinesCategory->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $medicinesCategory->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.medicines-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
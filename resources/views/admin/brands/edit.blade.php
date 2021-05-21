@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.brand.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.brands.update", [$brand->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="pharmacy_id">{{ trans('cruds.brand.fields.pharmacy') }}</label>
                <select class="form-control select2 {{ $errors->has('pharmacy') ? 'is-invalid' : '' }}" name="pharmacy_id" id="pharmacy_id" required>
                    @foreach($pharmacies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('pharmacy_id') ? old('pharmacy_id') : $brand->pharmacy->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('pharmacy'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pharmacy') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.brand.fields.pharmacy_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.brand.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $brand->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.brand.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
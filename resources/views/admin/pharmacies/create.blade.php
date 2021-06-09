@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.pharmacy.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.pharmacies.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="name">{{ trans('cruds.pharmacy.fields.name') }}</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                        @if($errors->has('name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.pharmacy.fields.name_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="description">{{ trans('cruds.pharmacy.fields.description') }}</label>
                        <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}">
                        @if($errors->has('description'))
                            <div class="invalid-feedback">
                                {{ $errors->first('description') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.pharmacy.fields.description_helper') }}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="phone">{{ trans('cruds.pharmacy.fields.phone') }}</label>
                        <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required>
                        @if($errors->has('phone'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.pharmacy.fields.phone_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="address">{{ trans('cruds.pharmacy.fields.address') }}</label>
                        <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}" required>
                        @if($errors->has('address'))
                            <div class="invalid-feedback">
                                {{ $errors->first('address') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.pharmacy.fields.address_helper') }}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="opening_time">{{ trans('cruds.pharmacy.fields.opening_time') }}</label>
                        <input class="form-control timepicker {{ $errors->has('opening_time') ? 'is-invalid' : '' }}" type="text" name="opening_time" id="opening_time" value="{{ old('opening_time') }}" required>
                        @if($errors->has('opening_time'))
                            <div class="invalid-feedback">
                                {{ $errors->first('opening_time') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.pharmacy.fields.opening_time_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="closing_time">{{ trans('cruds.pharmacy.fields.closing_time') }}</label>
                        <input class="form-control timepicker {{ $errors->has('closing_time') ? 'is-invalid' : '' }}" type="text" name="closing_time" id="closing_time" value="{{ old('closing_time') }}" required>
                        @if($errors->has('closing_time'))
                            <div class="invalid-feedback">
                                {{ $errors->first('closing_time') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.pharmacy.fields.closing_time_helper') }}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="longitude">{{ trans('cruds.pharmacy.fields.longitude') }}</label>
                        <input class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}" type="text" name="longitude" id="longitude" value="{{ old('longitude', '') }}" required>
                        @if($errors->has('longitude'))
                            <div class="invalid-feedback">
                                {{ $errors->first('longitude') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.pharmacy.fields.longitude_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="latitude">{{ trans('cruds.pharmacy.fields.latitude') }}</label>
                        <input class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" type="text" name="latitude" id="latitude" value="{{ old('latitude', '') }}" required>
                        @if($errors->has('latitude'))
                            <div class="invalid-feedback">
                                {{ $errors->first('latitude') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.pharmacy.fields.latitude_helper') }}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                        <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                        @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                    </div>
                </div>
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

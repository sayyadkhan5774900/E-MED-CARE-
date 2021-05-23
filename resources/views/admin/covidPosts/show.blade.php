@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.covidPost.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.covid-posts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered ">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.covidPost.fields.id') }}
                        </th>
                        <td>
                            {{ $covidPost->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.covidPost.fields.title') }}
                        </th>
                        <td>
                            {{ $covidPost->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.covidPost.fields.excerpt') }}
                        </th>
                        <td>
                            {{ $covidPost->excerpt }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.covidPost.fields.detail') }}
                        </th>
                        <td>
                            {{ $covidPost->detail }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.covidPost.fields.image') }}
                        </th>
                        <td>
                            @if($covidPost->image)
                                <a href="{{ $covidPost->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $covidPost->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.covid-posts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
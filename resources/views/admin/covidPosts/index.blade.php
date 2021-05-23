@extends('layouts.admin')
@section('content')
@can('covid_post_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.covid-posts.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.covidPost.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.covidPost.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered  table-hover datatable datatable-CovidPost">
                <thead class="table-heade">

                    <tr>
                        <th>
                            {{ trans('cruds.covidPost.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.covidPost.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.covidPost.fields.excerpt') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($covidPosts as $key => $covidPost)
                        <tr data-entry-id="{{ $covidPost->id }}">
                            <td>
                                {{ $covidPost->id ?? '' }}
                            </td>
                            <td>
                                {{ $covidPost->title ?? '' }}
                            </td>
                            <td>
                                {{ $covidPost->excerpt ?? '' }}
                            </td>
                            <td>
                                @can('covid_post_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.covid-posts.show', $covidPost->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('covid_post_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.covid-posts.edit', $covidPost->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('covid_post_delete')
                                    <form action="{{ route('admin.covid-posts.destroy', $covidPost->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    pageLength: 25,
  });
  let table = $('.datatable-CovidPost:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
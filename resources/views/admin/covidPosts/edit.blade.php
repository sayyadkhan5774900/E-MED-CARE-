@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.covidPost.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.covid-posts.update", [$covidPost->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.covidPost.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $covidPost->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.covidPost.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="excerpt">{{ trans('cruds.covidPost.fields.excerpt') }}</label>
                <input class="form-control {{ $errors->has('excerpt') ? 'is-invalid' : '' }}" type="text" name="excerpt" id="excerpt" value="{{ old('excerpt', $covidPost->excerpt) }}" required>
                @if($errors->has('excerpt'))
                    <div class="invalid-feedback">
                        {{ $errors->first('excerpt') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.covidPost.fields.excerpt_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="detail">{{ trans('cruds.covidPost.fields.detail') }}</label>
                <textarea class="form-control {{ $errors->has('detail') ? 'is-invalid' : '' }}" name="detail" id="detail" required>{{ old('detail', $covidPost->detail) }}</textarea>
                @if($errors->has('detail'))
                    <div class="invalid-feedback">
                        {{ $errors->first('detail') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.covidPost.fields.detail_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="image">{{ trans('cruds.covidPost.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.covidPost.fields.image_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.covid-posts.storeMedia') }}',
    maxFilesize: 5, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($covidPost) && $covidPost->image)
      var file = {!! json_encode($covidPost->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection
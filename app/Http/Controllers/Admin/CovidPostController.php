<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCovidPostRequest;
use App\Http\Requests\StoreCovidPostRequest;
use App\Http\Requests\UpdateCovidPostRequest;
use App\Models\CovidPost;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class CovidPostController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('covid_post_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $covidPosts = CovidPost::with(['media'])->get();

        return view('admin.covidPosts.index', compact('covidPosts'));
    }

    public function create()
    {
        abort_if(Gate::denies('covid_post_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.covidPosts.create');
    }

    public function store(StoreCovidPostRequest $request)
    {
        $covidPost = CovidPost::create($request->all());

        if ($request->input('image', false)) {
            $covidPost->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $covidPost->id]);
        }

        return redirect()->route('admin.covid-posts.index');
    }

    public function edit(CovidPost $covidPost)
    {
        abort_if(Gate::denies('covid_post_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.covidPosts.edit', compact('covidPost'));
    }

    public function update(UpdateCovidPostRequest $request, CovidPost $covidPost)
    {
        $covidPost->update($request->all());

        if ($request->input('image', false)) {
            if (!$covidPost->image || $request->input('image') !== $covidPost->image->file_name) {
                if ($covidPost->image) {
                    $covidPost->image->delete();
                }
                $covidPost->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($covidPost->image) {
            $covidPost->image->delete();
        }

        return redirect()->route('admin.covid-posts.index');
    }

    public function show(CovidPost $covidPost)
    {
        abort_if(Gate::denies('covid_post_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.covidPosts.show', compact('covidPost'));
    }

    public function destroy(CovidPost $covidPost)
    {
        abort_if(Gate::denies('covid_post_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $covidPost->delete();

        return back();
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('covid_post_create') && Gate::denies('covid_post_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new CovidPost();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

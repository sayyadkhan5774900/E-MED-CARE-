<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCovidPostRequest;
use App\Http\Requests\UpdateCovidPostRequest;
use App\Http\Resources\Admin\CovidPostResource;
use App\Models\CovidPost;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CovidPostApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('covid_post_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CovidPostResource(CovidPost::all());
    }

    public function store(StoreCovidPostRequest $request)
    {
        $covidPost = CovidPost::create($request->all());

        if ($request->input('image', false)) {
            $covidPost->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new CovidPostResource($covidPost))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(CovidPost $covidPost)
    {
        abort_if(Gate::denies('covid_post_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CovidPostResource($covidPost);
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

        return (new CovidPostResource($covidPost))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(CovidPost $covidPost)
    {
        abort_if(Gate::denies('covid_post_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $covidPost->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

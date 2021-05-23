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
        return CovidPostResource::collection(CovidPost::all());
    }

    public function show(CovidPost $covidPost)
    {
        return new CovidPostResource($covidPost);
    }

}

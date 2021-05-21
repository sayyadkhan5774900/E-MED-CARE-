<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMedicinesCategoryRequest;
use App\Http\Requests\UpdateMedicinesCategoryRequest;
use App\Http\Resources\Admin\MedicinesCategoryResource;
use App\Models\MedicinesCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MedicinesCategoriesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('medicines_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MedicinesCategoryResource(MedicinesCategory::with(['pharmacy', 'parent_category'])->get());
    }

    public function store(StoreMedicinesCategoryRequest $request)
    {
        $medicinesCategory = MedicinesCategory::create($request->all());

        if ($request->input('image', false)) {
            $medicinesCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new MedicinesCategoryResource($medicinesCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MedicinesCategory $medicinesCategory)
    {
        abort_if(Gate::denies('medicines_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MedicinesCategoryResource($medicinesCategory->load(['pharmacy', 'parent_category']));
    }

    public function update(UpdateMedicinesCategoryRequest $request, MedicinesCategory $medicinesCategory)
    {
        $medicinesCategory->update($request->all());

        if ($request->input('image', false)) {
            if (!$medicinesCategory->image || $request->input('image') !== $medicinesCategory->image->file_name) {
                if ($medicinesCategory->image) {
                    $medicinesCategory->image->delete();
                }
                $medicinesCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($medicinesCategory->image) {
            $medicinesCategory->image->delete();
        }

        return (new MedicinesCategoryResource($medicinesCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MedicinesCategory $medicinesCategory)
    {
        abort_if(Gate::denies('medicines_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medicinesCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

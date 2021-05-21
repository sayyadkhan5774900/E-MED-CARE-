<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMedicinesCategoryRequest;
use App\Http\Requests\StoreMedicinesCategoryRequest;
use App\Http\Requests\UpdateMedicinesCategoryRequest;
use App\Models\MedicinesCategory;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class MedicinesCategoriesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('medicines_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medicinesCategories = MedicinesCategory::with(['parent_category', 'media'])->get();

        return view('admin.medicinesCategories.index', compact('medicinesCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('medicines_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parent_categories = MedicinesCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.medicinesCategories.create', compact('parent_categories'));
    }

    public function store(StoreMedicinesCategoryRequest $request)
    {
        $medicinesCategory = MedicinesCategory::create($request->all());

        if ($request->input('image', false)) {
            $medicinesCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $medicinesCategory->id]);
        }

        return redirect()->route('admin.medicines-categories.index');
    }

    public function edit(MedicinesCategory $medicinesCategory)
    {
        abort_if(Gate::denies('medicines_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $parent_categories = MedicinesCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $medicinesCategory->load('parent_category');

        return view('admin.medicinesCategories.edit', compact('parent_categories', 'medicinesCategory'));
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

        return redirect()->route('admin.medicines-categories.index');
    }

    public function show(MedicinesCategory $medicinesCategory)
    {
        abort_if(Gate::denies('medicines_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medicinesCategory->load('parent_category');

        return view('admin.medicinesCategories.show', compact('medicinesCategory'));
    }

    public function destroy(MedicinesCategory $medicinesCategory)
    {
        abort_if(Gate::denies('medicines_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medicinesCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyMedicinesCategoryRequest $request)
    {
        MedicinesCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('medicines_category_create') && Gate::denies('medicines_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MedicinesCategory();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

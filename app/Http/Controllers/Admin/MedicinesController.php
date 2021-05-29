<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMedicineRequest;
use App\Http\Requests\StoreMedicineRequest;
use App\Http\Requests\UpdateMedicineRequest;
use App\Models\Brand;
use App\Models\Medicine;
use App\Models\MedicinesCategory;
use App\Models\Pharmacy;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class MedicinesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('medicine_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medicines = Medicine::with(['pharmacy', 'category', 'brand', 'media'])->get();

        return view('admin.medicines.index', compact('medicines'));
    }

    public function create()
    {
        abort_if(Gate::denies('medicine_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pharmacies = Pharmacy::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = MedicinesCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $brands = Brand::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.medicines.create', compact('pharmacies', 'categories', 'brands'));
    }

    public function store(StoreMedicineRequest $request)
    {
        $medicine = Medicine::create($request->all());

        if ($request->input('image', false)) {
            $medicine->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $medicine->id]);
        }

        return redirect()->route('admin.medicines.index');
    }

    public function edit(Medicine $medicine)
    {
        abort_if(Gate::denies('medicine_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pharmacies = Pharmacy::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = MedicinesCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $brands = Brand::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $medicine->load('pharmacy', 'category', 'brand');

        return view('admin.medicines.edit', compact('pharmacies', 'categories', 'brands', 'medicine'));
    }

    public function update(UpdateMedicineRequest $request, Medicine $medicine)
    {
        $medicine->update($request->all());

        if ($request->input('image', false)) {
            if (!$medicine->image || $request->input('image') !== $medicine->image->file_name) {
                if ($medicine->image) {
                    $medicine->image->delete();
                }
                $medicine->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($medicine->image) {
            $medicine->image->delete();
        }

        return redirect()->route('admin.medicines.index');
    }

    public function show(Medicine $medicine)
    {
        abort_if(Gate::denies('medicine_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medicine->load('pharmacy', 'category', 'brand');

        return view('admin.medicines.show', compact('medicine'));
    }

    public function destroy(Medicine $medicine)
    {
        abort_if(Gate::denies('medicine_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medicine->delete();

        return back();
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('medicine_create') && Gate::denies('medicine_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Medicine();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

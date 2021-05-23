<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMedicineRequest;
use App\Http\Requests\UpdateMedicineRequest;
use App\Http\Resources\Admin\MedicineResource;
use App\Models\Medicine;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MedicinesApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('medicine_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MedicineResource(Medicine::with(['pharmacy', 'category', 'brand'])->get());
    }

    public function store(StoreMedicineRequest $request)
    {
        $medicine = Medicine::create($request->all());

        if ($request->input('image', false)) {
            $medicine->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new MedicineResource($medicine))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Medicine $medicine)
    {
        abort_if(Gate::denies('medicine_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MedicineResource($medicine->load(['pharmacy', 'category', 'brand']));
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

        return (new MedicineResource($medicine))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Medicine $medicine)
    {
        abort_if(Gate::denies('medicine_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medicine->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

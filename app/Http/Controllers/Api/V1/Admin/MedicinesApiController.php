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
    public function index()
    {
        return  MedicineResource::collection(Medicine::with(['pharmacy', 'category', 'brand'])->get());
    }

    public function show(Medicine $medicine)
    {
        return new MedicineResource($medicine->load(['pharmacy', 'category']));
    }

}

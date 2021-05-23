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
    public function index()
    {
        return  MedicinesCategoryResource::collection(MedicinesCategory::with(['parent_category'])->get());
    }

    public function show(MedicinesCategory $medicinesCategory)
    {
        return new MedicinesCategoryResource($medicinesCategory->load(['parent_category']));
    }
}

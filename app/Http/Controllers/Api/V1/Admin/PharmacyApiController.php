<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePharmacyRequest;
use App\Http\Requests\UpdatePharmacyRequest;
use App\Http\Resources\Admin\MedicineResource;
use App\Http\Resources\Admin\PharmacyResource;
use App\Models\Medicine;
use App\Models\MedicinesCategory;
use App\Models\Pharmacy;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PharmacyApiController extends Controller
{
    public function index()
    {
        return PharmacyResource::collection(Pharmacy::with(['owner'])->get());
    }

    public function medicines(Pharmacy $pharmacy)
    {
        $medicine = $pharmacy->pharmacyMedicines->load(['pharmacy', 'category', 'brand']);
        return  MedicineResource::collection($medicine);
    }

    public function medicinesByCategory(Pharmacy $pharmacy, MedicinesCategory $medicinesCategory)
    {
        $medicine = Medicine::where('pharmacy_id',$pharmacy->id)
                    ->where('category_id',$medicinesCategory->id)
                    ->with(['pharmacy', 'category', 'brand'])->get();
                    
        return  MedicineResource::collection($medicine);
    }

    public function show(Pharmacy $pharmacy)
    {
        return new PharmacyResource($pharmacy->load(['owner']));
    }

}

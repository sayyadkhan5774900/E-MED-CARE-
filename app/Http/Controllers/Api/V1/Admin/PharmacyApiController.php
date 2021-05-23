<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePharmacyRequest;
use App\Http\Requests\UpdatePharmacyRequest;
use App\Http\Resources\Admin\PharmacyResource;
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

    public function show(Pharmacy $pharmacy)
    {
        return new PharmacyResource($pharmacy->load(['owner']));
    }

}

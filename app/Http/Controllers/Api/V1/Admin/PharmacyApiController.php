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
        abort_if(Gate::denies('pharmacy_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PharmacyResource(Pharmacy::with(['owner'])->get());
    }

    public function store(StorePharmacyRequest $request)
    {
        $pharmacy = Pharmacy::create($request->all());

        return (new PharmacyResource($pharmacy))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Pharmacy $pharmacy)
    {
        abort_if(Gate::denies('pharmacy_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PharmacyResource($pharmacy->load(['owner']));
    }

    public function update(UpdatePharmacyRequest $request, Pharmacy $pharmacy)
    {
        $pharmacy->update($request->all());

        return (new PharmacyResource($pharmacy))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Pharmacy $pharmacy)
    {
        abort_if(Gate::denies('pharmacy_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pharmacy->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

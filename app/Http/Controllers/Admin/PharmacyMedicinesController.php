<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPharmacyMedicineRequest;
use App\Http\Requests\StorePharmacyMedicineRequest;
use App\Http\Requests\UpdatePharmacyMedicineRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PharmacyMedicinesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pharmacy_medicine_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pharmacyMedicines.index');
    }

    public function create()
    {
        abort_if(Gate::denies('pharmacy_medicine_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pharmacyMedicines.create');
    }

    public function store(StorePharmacyMedicineRequest $request)
    {
        $pharmacyMedicine = PharmacyMedicine::create($request->all());

        return redirect()->route('admin.pharmacy-medicines.index');
    }

    public function edit(PharmacyMedicine $pharmacyMedicine)
    {
        abort_if(Gate::denies('pharmacy_medicine_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pharmacyMedicines.edit', compact('pharmacyMedicine'));
    }

    public function update(UpdatePharmacyMedicineRequest $request, PharmacyMedicine $pharmacyMedicine)
    {
        $pharmacyMedicine->update($request->all());

        return redirect()->route('admin.pharmacy-medicines.index');
    }

    public function show(PharmacyMedicine $pharmacyMedicine)
    {
        abort_if(Gate::denies('pharmacy_medicine_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pharmacyMedicines.show', compact('pharmacyMedicine'));
    }

    public function destroy(PharmacyMedicine $pharmacyMedicine)
    {
        abort_if(Gate::denies('pharmacy_medicine_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pharmacyMedicine->delete();

        return back();
    }

    public function massDestroy(MassDestroyPharmacyMedicineRequest $request)
    {
        PharmacyMedicine::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

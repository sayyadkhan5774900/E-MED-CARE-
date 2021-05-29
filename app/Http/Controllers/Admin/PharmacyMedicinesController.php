<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPharmacyMedicineRequest;
use App\Http\Requests\StorePharmacyMedicineRequest;
use App\Http\Requests\UpdatePharmacyMedicineRequest;
use App\Models\Brand;
use App\Models\Medicine;
use App\Models\MedicinesCategory;
use App\Models\Pharmacy;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PharmacyMedicinesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('pharmacy_medicine_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medicines = Medicine::where('pharmacy_id',auth()->user()->id)->with(['pharmacy', 'category', 'brand', 'media'])->get();

        return view('admin.pharmacyMedicines.index',compact('medicines'));
    }

    public function create()
    {
        abort_if(Gate::denies('pharmacy_medicine_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = MedicinesCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $brands = Brand::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.pharmacyMedicines.create',compact('categories', 'brands'));
    }

    public function store(StorePharmacyMedicineRequest $request)
    {
        $medicine = Medicine::create([
            'category_id' => $request['category_id'],
            'name' => $request['name'],
            'description' => $request['description'],
            'price' => $request['price'],
            'in_stock' => $request['in_stock'],
            'expiry_date' => $request['expiry_date'],
            'pharmacy_id' => Pharmacy::where('owner_id',auth()->user()->id)->get()[0]->id,
        ]);

        if ($request->input('image', false)) {
            $medicine->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $medicine->id]);
        }

        return redirect()->route('admin.pharmacy-medicines.index');
    }

    public function edit($pharmacyMedicine)
    {
        abort_if(Gate::denies('pharmacy_medicine_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medicine = Medicine::find($pharmacyMedicine);

        $categories = MedicinesCategory::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $brands = Brand::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $medicine->load('pharmacy', 'category', 'brand');

        return view('admin.pharmacyMedicines.edit', compact('categories', 'brands', 'medicine'));
    }

    public function update(UpdatePharmacyMedicineRequest $request,  $pharmacyMedicine)
    {
        $medicine = Medicine::find($pharmacyMedicine);

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

        return redirect()->route('admin.pharmacy-medicines.index');
    }

    public function show($pharmacyMedicine)
    {
        abort_if(Gate::denies('pharmacy_medicine_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       
        $medicine = Medicine::find($pharmacyMedicine);

        return view('admin.pharmacyMedicines.show', compact('medicine'));
    }

    public function destroy($pharmacyMedicine)
    {
        abort_if(Gate::denies('pharmacy_medicine_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $medicine = Medicine::find($pharmacyMedicine);

        $medicine->delete();

        return back();
    }
}

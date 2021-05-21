<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBrandRequest;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use App\Models\Pharmacy;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BrandController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('brand_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brands = Brand::with(['pharmacy'])->get();

        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        abort_if(Gate::denies('brand_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pharmacies = Pharmacy::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.brands.create', compact('pharmacies'));
    }

    public function store(StoreBrandRequest $request)
    {
        $brand = Brand::create($request->all());

        return redirect()->route('admin.brands.index');
    }

    public function edit(Brand $brand)
    {
        abort_if(Gate::denies('brand_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pharmacies = Pharmacy::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $brand->load('pharmacy');

        return view('admin.brands.edit', compact('pharmacies', 'brand'));
    }

    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $brand->update($request->all());

        return redirect()->route('admin.brands.index');
    }

    public function show(Brand $brand)
    {
        abort_if(Gate::denies('brand_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brand->load('pharmacy');

        return view('admin.brands.show', compact('brand'));
    }

    public function destroy(Brand $brand)
    {
        abort_if(Gate::denies('brand_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brand->delete();

        return back();
    }

    public function massDestroy(MassDestroyBrandRequest $request)
    {
        Brand::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

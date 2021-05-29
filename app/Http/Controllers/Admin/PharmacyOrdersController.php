<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPharmacyOrderRequest;
use App\Http\Requests\StorePharmacyOrderRequest;
use App\Http\Requests\UpdatePharmacyOrderRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PharmacyOrdersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pharmacy_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pharmacyOrders.index');
    }

    public function create()
    {
        abort_if(Gate::denies('pharmacy_order_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pharmacyOrders.create');
    }

    public function store(StorePharmacyOrderRequest $request)
    {
        $pharmacyOrder = PharmacyOrder::create($request->all());

        return redirect()->route('admin.pharmacy-orders.index');
    }

    public function edit(PharmacyOrder $pharmacyOrder)
    {
        abort_if(Gate::denies('pharmacy_order_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pharmacyOrders.edit', compact('pharmacyOrder'));
    }

    public function update(UpdatePharmacyOrderRequest $request, PharmacyOrder $pharmacyOrder)
    {
        $pharmacyOrder->update($request->all());

        return redirect()->route('admin.pharmacy-orders.index');
    }

    public function show(PharmacyOrder $pharmacyOrder)
    {
        abort_if(Gate::denies('pharmacy_order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pharmacyOrders.show', compact('pharmacyOrder'));
    }

    public function destroy(PharmacyOrder $pharmacyOrder)
    {
        abort_if(Gate::denies('pharmacy_order_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pharmacyOrder->delete();

        return back();
    }
}

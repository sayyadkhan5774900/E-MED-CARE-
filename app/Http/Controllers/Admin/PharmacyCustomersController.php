<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPharmacyCustomerRequest;
use App\Http\Requests\StorePharmacyCustomerRequest;
use App\Http\Requests\UpdatePharmacyCustomerRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PharmacyCustomersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pharmacy_customer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pharmacyCustomers.index');
    }

    public function create()
    {
        abort_if(Gate::denies('pharmacy_customer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pharmacyCustomers.create');
    }

    public function store(StorePharmacyCustomerRequest $request)
    {
        $pharmacyCustomer = PharmacyCustomer::create($request->all());

        return redirect()->route('admin.pharmacy-customers.index');
    }

    public function edit(PharmacyCustomer $pharmacyCustomer)
    {
        abort_if(Gate::denies('pharmacy_customer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pharmacyCustomers.edit', compact('pharmacyCustomer'));
    }

    public function update(UpdatePharmacyCustomerRequest $request, PharmacyCustomer $pharmacyCustomer)
    {
        $pharmacyCustomer->update($request->all());

        return redirect()->route('admin.pharmacy-customers.index');
    }

    public function show(PharmacyCustomer $pharmacyCustomer)
    {
        abort_if(Gate::denies('pharmacy_customer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pharmacyCustomers.show', compact('pharmacyCustomer'));
    }

    public function destroy(PharmacyCustomer $pharmacyCustomer)
    {
        abort_if(Gate::denies('pharmacy_customer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pharmacyCustomer->delete();

        return back();
    }
}

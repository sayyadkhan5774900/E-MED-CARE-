<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCustomerDetailRequest;
use App\Http\Requests\StoreCustomerDetailRequest;
use App\Http\Requests\UpdateCustomerDetailRequest;
use App\Models\CustomerDetail;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerDetailController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('customer_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customerDetails = CustomerDetail::with(['customer'])->get();

        return view('admin.customerDetails.index', compact('customerDetails'));
    }

    public function create()
    {
        abort_if(Gate::denies('customer_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customers = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.customerDetails.create', compact('customers'));
    }

    public function store(StoreCustomerDetailRequest $request)
    {
        $customerDetail = CustomerDetail::create($request->all());

        return redirect()->route('admin.customer-details.index');
    }

    public function edit(CustomerDetail $customerDetail)
    {
        abort_if(Gate::denies('customer_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customers = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $customerDetail->load('customer');

        return view('admin.customerDetails.edit', compact('customers', 'customerDetail'));
    }

    public function update(UpdateCustomerDetailRequest $request, CustomerDetail $customerDetail)
    {
        $customerDetail->update($request->all());

        return redirect()->route('admin.customer-details.index');
    }

    public function show(CustomerDetail $customerDetail)
    {
        abort_if(Gate::denies('customer_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customerDetail->load('customer');

        return view('admin.customerDetails.show', compact('customerDetail'));
    }

    public function destroy(CustomerDetail $customerDetail)
    {
        abort_if(Gate::denies('customer_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customerDetail->delete();

        return back();
    }
}

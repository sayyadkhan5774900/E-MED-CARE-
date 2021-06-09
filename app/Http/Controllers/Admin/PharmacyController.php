<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPharmacyRequest;
use App\Http\Requests\StorePharmacyRequest;
use App\Http\Requests\UpdatePharmacyRequest;
use App\Models\Pharmacy;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PharmacyController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pharmacy_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pharmacies = Pharmacy::with(['owner'])->get();

        return view('admin.pharmacies.index', compact('pharmacies'));
    }

    public function create()
    {
        abort_if(Gate::denies('pharmacy_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $owners = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.pharmacies.create', compact('owners'));
    }

    public function store(StorePharmacyRequest $request)
    {
        $request->validate([
            'email' => [
                'required',
                'unique:users',
            ],
            'password' => [
                'required',
            ]
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => $request['password'],
        ]);

        $user->roles()->sync(4);

        $pharmacy = Pharmacy::create([
            'name' => $request['name'],
            'description' =>  $request['description'] ,
            'phone' => $request['phone'] ,
            'address' => $request['address'] ,
            'opening_time' => $request['opening_time'] ,
            'closing_time' => $request['closing_time'] ,
            'owner_id' => $user->id,
            'longitude' => $request['longitude'] ,
            'latitude' => $request['latitude']
        ]);

        return redirect()->route('admin.pharmacies.index');
    }

    public function edit(Pharmacy $pharmacy)
    {
        abort_if(Gate::denies('pharmacy_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pharmacy->load('owner');

        return view('admin.pharmacies.edit', compact('pharmacy'));
    }

    public function update(UpdatePharmacyRequest $request, Pharmacy $pharmacy)
    {
        $pharmacy->update($request->all());

        return redirect()->route('admin.pharmacies.index');
    }

    public function show(Pharmacy $pharmacy)
    {
        abort_if(Gate::denies('pharmacy_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pharmacy->load('owner', 'pharmacyMedicines');

        return view('admin.pharmacies.show', compact('pharmacy'));
    }

    public function destroy(Pharmacy $pharmacy)
    {
        abort_if(Gate::denies('pharmacy_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pharmacy->delete();

        return back();
    }
}

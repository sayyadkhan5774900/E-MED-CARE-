<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\Pharmacy;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class PharmacyOrdersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('pharmacy_order_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orders = Order::where('pharmacy_id', auth()->user()->pharmacy->id)->with(['pharmacy', 'customer'])->get();

        return view('admin.pharmacyOrders.index',compact('orders'));
    }

    public function updateStatus(Request $request, $pharmacyOrder)
    {
        $request->validate([
            'status' => ['required']
        ]);

        $order = Order::find($pharmacyOrder);

        $order->update($request->all());

        return redirect()->route('admin.pharmacy-orders.index');
    }

    public function show($pharmacyOrder)
    {
        abort_if(Gate::denies('pharmacy_order_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $order = Order::find($pharmacyOrder);

        $order->load('pharmacy', 'customer');
        $customer_details = DB::table('customer_details')->where('customer_id',$order->customer_id)->get();
        $customer_details = $customer_details[0];
        $medicines = DB::table('medicine_order')->select('id','order_id','medicine_id','quantity')->where('order_id',$order->id)->get();

        return view('admin.pharmacyOrders.show', compact('order','medicines','customer_details'));
    }
}

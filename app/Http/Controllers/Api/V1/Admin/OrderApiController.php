<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\OrderResource;
use App\Models\Order;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class OrderApiController extends Controller
{
    public function index()
    {
        return new OrderResource(Order::with(['pharmacy', 'customer'])->get());
    }

    public function show(Order $order)
    {
        return new OrderResource($order->load(['pharmacy', 'customer']));
    }


    public function store(Request $request)
    {

        $request->validate([
            'pharmacy_id' => 'required',
            'customer_id' => 'required',
        ]);

        $order = Order::create([
            'pharmacy_id' => $request->pharmacy_id,
            'customer_id' => $request->customer_id,
            'status' => 'pending',
        ]);

        foreach($request->medicines as $medicine){
            DB::table('medicine_order')->insert([
                'order_id' => $order->id,
                'medicine_id' => $medicine['id'],
                'quantity' => $medicine['quantity'],
            ]);
        }

        return (new OrderResource($order))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}

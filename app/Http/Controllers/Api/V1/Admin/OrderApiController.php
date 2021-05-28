<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\OrderResource;
use App\Models\Order;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class OrderApiController extends Controller
{
    // public function user_order(User $user)
    // {
    //     $orders_data = array();

    //     $orders = Order::where('customer_id',$user->id)->get();

    //     foreach($orders->toArray() as $order){
    //         $medicines = DB::table('medicine_order')->select('id','order_id','medicine_id','quantity')->where('order_id',$order['id'])->get()->toArray();
    //         return $medicines;
    //         $order = array_push($order,'medicines',$medicines);
    //         $orders_data = array_push($orders_data,'data',$order);
    //     }

    //     return $orders_data;

    //     return new OrderResource(Order::with(['pharmacy', 'customer'])->get());
    // }

    // public function show(Order $order)
    // {
    //     $medicines = DB::table('medicine_order')->select('id','order_id','medicine_id','quantity')->where('order_id',$order->id)->get()->toArray();

    //     return new OrderResource([
    //         'id' => $order->id,
    //         'status' => $order->status,
    //         'customer_id' => $order->customer_id,
    //         'pharmacy_id' => $order->pharmacy_id,
    //         'pharmacy_name' => $order->pharmacy ? $order->pharmacy->name : $order->pharmacy,
    //         'created_at' => $order->created_at,
    //         'medicines' => $medicines,
    //     ]);
    // }


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

        User::find($request->customer_id)->customerDetail()->update([
            'province' => $request->province,
            'city' => $request->city,
            'phone' => $request->phone,
            'address' => $request->address,
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

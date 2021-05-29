<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderProduct;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function list(){

        $orders = Order::paginate('15');
        return view('admin.order-list')
        ->with('orders',$orders);
    }

    public function details($id){
        $order = Order::find($id);
        $statuses = Order::STATUSES;
        return view('admin.order-details')
        ->with('statuses',$statuses)
        ->with('order',$order);
    }

    public function edit($id){

        $order = Order::find($id);
        if(request()->has('order_status')){
            $order->status = request()->input('order_status');
        }
        if(request()->has('tracking_number')){
            $order->tracking_number = request()->input('tracking_number');
        }
        if(request()->has('product_amount')){
            foreach (request()->input('product_amount') as $orderProductId => $amount) {
                $orderProduct = OrderProduct::find($orderProductId);
                $orderProduct->amount_delivered = $amount;
                $orderProduct->save();
            }
            $order->status = request()->input('order_status');
        }


        $order->save();
        return redirect()->back();
    }
}

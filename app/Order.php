<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $guarded = [];

    const STATUSES = [
        0 => "Nieopłacone",
        1 => "Opłacone",
        2 => "W trakcie realizacji",
        3 => "Zrealizowane",
        4 => "Anulowane",
    ];

    public function address(){
        // return $this->hasOne(OrderAddress::class,'address_id');
        return $this->belongsTo(OrderAddress::class,'address_id');
    }

    public function products(){
        return $this->hasMany(OrderProduct::class,'order_id');
    }

    public function getStatusText(){
        return self::STATUSES[$this->status];
    }

    public function delivery(){
        return $this->belongsTo(Delivery::class,'delivery_id');
    }

    public function getOrderAmount(){
        $query = DB::table('orders_products')->select(DB::raw('sum(amount * price) as sum'))->where('order_id',$this->id)->first();
        return $query->sum;
    }

}

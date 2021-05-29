<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
    protected $guarded = [];
    public $table = 'orders_addresses';

    public function getClientName(){
        return $this->name. " " .$this->surname;
    }
}

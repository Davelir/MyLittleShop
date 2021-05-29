<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    public $table = 'products_attributes';

    public function attribute(){
        return $this->belongsTo('App\Attribute','attribute_id','id');
    }
    public function value(){
        return $this->belongsTo('App\AttributeValue','value_id','id');
    }
}

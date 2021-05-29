<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Attribute extends Model
{
    public function productAttribute(){
        return $this->belongsTo('App\ProductAttribute','attribute_id');
    }

    public function getAvaibleValues(){
        $valuesId = DB::table('products_attributes')->join('attributes_values','attributes_values.id','=','products_attributes.value_id')->groupBy('products_attributes.value_id')->where('products_attributes.attribute_id',$this->id)->pluck('products_attributes.value_id');

        return AttributeValue::whereIn('id',$valuesId)->get();
    }
}

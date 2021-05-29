<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    public $table = "attributes_values";

    public function productAttribute(){
        return $this->hasMany('App\ProductAttribute','value_id');
    }
}

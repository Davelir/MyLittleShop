<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    const STATUS = [
        1 => "Aktywny",
        0 => "Nie aktywny"
    ];
    const DEFAULT_IMG = 'test_img.jpg';
    const IMG_PATH = "/img/products/";
    public function getImageUri(){
        if(empty($this->image)){
            return self::IMG_PATH.'test_img.jpg';
        }
        return self::IMG_PATH.$this->image;
    }

    public function getProductUri(){
        return "/{$this->alias},{$this->id}";
    }

    public function getSimilarProducts(){
        return Product::where('category_id',$this->category_id)->limit(6)->get() ?? [];
    }

    public function reviews(){
        return $this->hasMany('App\Review');
    }
    public function attributes(){
        return $this->hasMany('App\ProductAttribute');
    }
    public function category(){
        return $this->belongsTo('App\Category');
    }

    public static function createAlias($name){
        return trim(preg_replace('/\W+/', '-', strtolower(trim($name))));
    }
    public function scopeFilter($query,$params){

        if(isset($params['name'])){
            $query->where('name','like','%'.$params['name'].'%');
        }

        if(isset($params['price'])){
         $query->whereBetween('price',$params['price']);
        }

        if(isset($params['tags'])){

            $product_ids = DB::table('products')
            ->join('products_attributes','products_attributes.product_id','=','products.id')
            ->where(function($subquery) use($params){
                foreach ($params['tags'] as $attribute_id =>$value_ids) {
                    $subquery->where('products_attributes.attribute_id',$attribute_id)
                            ->whereIn('products_attributes.value_id',$value_ids);
                }
            })
            ->pluck('products.id');

            $query->whereIn('id',$product_ids);
        }

        return $query;
    }

    public function getStatusText(){
        return self::STATUS[$this->active];
    }
}

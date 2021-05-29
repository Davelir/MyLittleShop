<?php

namespace App\Http\Controllers\Admin;

use App\Attribute;
use App\AttributeValue;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductAttribute;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list(){

        $products = Product::get();
        // dd($produkty);
        return view('Admin.product-list')->with('products',$products);
    }

    public function edit($id){
        $product = Product::with('attributes')->findOrFail($id);
        $attributes = Attribute::all();
        $categories = Category::get();
        $attributesValues = AttributeValue::all();
        return view('Admin.product-edit')
        ->with('product',$product)
        ->with('categories',$categories)
        ->with('attributes',$attributes)
        ->with('attributesValues',$attributesValues);
    }

    public function save($id){

        $product = Product::findOrFail($id);

        if(request()->has('save_product')){
            $image = request()->file('image');
            if($image){
                $image->storeAs('',md5($product->id).'.'.$image->extension(),['disk' => 'products']);
                $product->image = md5($product->id).'.'.$image->extension();
            }
            $price = str_replace(",",".",request()->price);
            $product->name = request()->name;
            $product->price = $price;
            $product->category_id = request()->category_id;
            $product->description = request()->description;
            $product->save();
        }

        if(request()->has('add_attribute')){
            $productAttribute = new ProductAttribute();
            $productAttribute->product_id = $product->id;
            $productAttribute->attribute_id = request()->input('add_attribute_name');
            $productAttribute->value_id = request()->input('add_attribute_value');
            $productAttribute->save();
        }
        if(request()->has('delete_attribute')){
            $attribute = ProductAttribute::find(request()->input('delete_attribute'));
            $attribute->delete();
        }




        session()->flash('success', 'Zapisano zmiany!');
        return back();
    }
    public function create(){
        $name = request()->name;
        $product = new Product();
        $product->name = $name;
        $product->price = 0;
        $product->alias = Product::createAlias($name);
        $product->description = '';
        $product->image = Product::DEFAULT_IMG;
        $product->active = 0;
        $product->category_id = 1;
        $product->save();

        return redirect()->route('AdminProductEdit',['id' => $product->id]);
    }
}

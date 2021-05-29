<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    const NEW_PRODUCTS = 6;
    const MAIN_BOX_CATEGORIES = 4;

    public function index(){

        $categories = Category::where("parent_id",null)->limit(self::MAIN_BOX_CATEGORIES)->get();
        $newProducts = Product::where("active",1)->limit(self::NEW_PRODUCTS)->get();
        $alsoProducts = Product::where("active",1)->limit(self::NEW_PRODUCTS)->offset(self::NEW_PRODUCTS)->get();

        return view('index')
        ->with("categories",$categories)
        ->with("newProducts",$newProducts)
        ->with("alsoProducts",$alsoProducts);
    }
}

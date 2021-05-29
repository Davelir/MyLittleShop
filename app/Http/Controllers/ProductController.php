<?php

namespace App\Http\Controllers;

use App\Breadcrumb;
use App\Product;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index($product_alias,$product_id){

        $product = Product::where('id',$product_id)->where('alias',$product_alias)->firstOrFail();

        $breadcrumbs = new Breadcrumb;

        $breadcrumbs->addItem("Katalog","/category");
        if($product->category_id){
            $allCategoriesUpper = $product->category->getTree();
            foreach ($allCategoriesUpper as $categoryTmp) {
                $breadcrumbs->addItem($categoryTmp->name,$categoryTmp->getUrl());
            }
        }
        $breadcrumbs->addItem($product->name,"");
        $reviews = $product->reviews;

        return view('product')
        ->with('product',$product)
        ->with('breadcrumbs',$breadcrumbs)
        ->with('reviews',$reviews);
    }

    public function addReview($id){
        request()->validate([
            'rate' => 'required:integer',
            'review' => 'required',
        ],[
            'rate.required' => 'Ocena wymagana!',
            'rate.integer' => 'Ocena nieprawidłowa!',
            'review.required' => 'Treśc nie może być pusta',
        ]);

        $review = new Review;
        $review->rate = request()->rate;
        $review->review = request()->review;
        $review->product_id = $id;
        $review->user_id = Auth::user()->id;
        $review->save();

        // dd($review);
        return redirect()->back();

    }
}

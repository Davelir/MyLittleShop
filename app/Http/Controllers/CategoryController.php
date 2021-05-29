<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\AttributeValue;
use App\Breadcrumb;
use App\Category;
use App\Product;
use App\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function category($category_alias = null,$category_id = null){
        //Aktualna kategoria
        $category = Category::where('id',$category_id)->where('alias',$category_alias)->first();

        //Podkategorie
        $categories = Category::where('parent_id',$category_id)->get();

        // Produkty
        $childCategoriesId = [];
        if($category){
            $childs = $category->allSubCategories->toArray();
        }else{
            $childs = Category::with('child')->get()->toArray();
        }

        $childs = flatten($childs);
        foreach ($childs as $sub) {
            $childCategoriesId[] = $sub['id'];
        }
        if($category) $childCategoriesId[] = $category->id;


        $filters = [];

        //Filtr nazwy
        $searchString = false;
        if(request()->query('search',false)){
            $filters['name'] = request()->query('search');
            $searchString = request()->query("search");
        }
        // Filtr ceny
        if(isset(request()->price)){
            $priceFilter = explode(",",request()->price);
            $filters['price'] = $priceFilter;
        }

        // Filtr tagów (attributes)
        if(isset(request()->tags)){
            $tagsFilterAll = explode(",",request()->tags);
            $tagsFilter = [];
            foreach ($tagsFilterAll as $tag) {
                $tag = explode(":",$tag);
                $tagsFilter[$tag[0]][] = $tag[1];
            }
            $filters['tags'] = $tagsFilter;
        }
        // Wszystkie aktywne produkty w aktualnej kategorii i kategoriach, które są niżej
        $productsInCategories = Product::whereIn('category_id',$childCategoriesId)->where('active',1);



        //nowe zbieranie dostepnych atrybutów
        $tmpProductsIds = [];
        $tagsIdAll = [];
        foreach($productsInCategories->select('id')->get()->toArray() as $productTmp){
            $tmpProductsIds[] = $productTmp["id"];
        }
        $allTags = DB::table('products_attributes')->whereIn('product_id',$tmpProductsIds)->groupBy('attribute_id')->get('attribute_id');
        foreach ($allTags as $tagTmp) {
            $tagsIdAll[] = $tagTmp->attribute_id;
        }

        // Zbieranie wszystkich dostępnych wartości atrybutów znalezionych wyzej
        $tags = [];
        $attributes = Attribute::whereIn('id',$tagsIdAll)->with('productAttribute')->get();

        // Zbieramy tagi do wyświetlnia w filtrach
        foreach ($attributes as $attribute) {
            $avaibleValues = $attribute->getAvaibleValues();

            $tags[] = [
                'attribute' => $attribute,
                'values' => $avaibleValues
            ];
        }

        // Pobieramy produkty do katalogu z aktualnymi parametrami
        $products = Product::whereIn('category_id',$childCategoriesId)->where('active',1)->filter($filters)->with('attributes')->paginate(5);

        // Pobieramy breadcrumbsy
        $breadcrumbs = new Breadcrumb;

        $breadcrumbs->addItem("Katalog","/category");
        if($category){
            $allCategoriesUpper = $category->getTree();
            foreach ($allCategoriesUpper as $categoryTmp) {
                $breadcrumbs->addItem($categoryTmp->name,$categoryTmp->getUrl());
            }
        }
        // dd($products);
        // Zwracamy widok
        return view('catalog')
        ->with('searchString',$searchString)
        ->with('categories',$categories)
        ->with('products',$products)
        ->with('tags',$tags)
        ->with('category',$category)
        ->with('breadcrumbs',$breadcrumbs);
    }
}

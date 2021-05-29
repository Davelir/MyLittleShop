<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function list(){

        $categoryList = Category::orderBy('name')->get();
        $mainCategories = Category::Where('parent_id',null)->get();
        return view('Admin.category-list')
        ->with('categoryList',$categoryList)
        ->with('mainCategories',$mainCategories);
    }

    public function create(){
        request()->validate([
            'name' => 'required',
            'parent_id' => 'required'
        ],[
            'name.required' => 'Nazwa jest wymagana!',
            'parent_id.required' => 'Określ miejsce kategorii!']
        );
        $parentId = request()->input('parent_id') == 0 ? null : request()->input('parent_id');
        $category = new Category;
        $category->name = request()->input('name');
        $category->alias = Category::createAlias(request()->input('name'));
        $category->parent_id = $parentId;
        $category->save();
        request()->session()->flash('success', 'Dodano kategorię!');
        return redirect()->back();
    }

    public function edit($id){
        $categoryList = Category::orderBy('name')->get();
        $category = Category::find($id);
        return view('Admin.category-edit')
        ->with('category',$category)
        ->with('categoryList',$categoryList);
    }

    public function save($id){
        $category = Category::find($id);

        if(request()->has('save_category')){
            $parentId = request()->input('parent_id') == 0 ? null : request()->input('parent_id');
            $category->name = request()->input('name');
            $category->alias = Category::createAlias(request()->input('name'));
            $category->parent_id = $parentId;
            $category->save();
            request()->session()->flash('success', 'Edytowano kategorię!');
            return redirect()->route('adminCategoryList');
        }

        if(request()->has('remove_category')){
            $parentId = $category->parent_id;

            //Sprawdzamy czy bezpośrednio do niej są jakieś produkty
            if(Product::where('category_id',$category->id)->get()->count() > 0){
                if($parentId === null){
                    request()->session()->flash('danger', 'Nie można usunąć kategorii głównej jeśli bezposrednio w niej są produkty!');
                    return redirect()->back();
                }

                DB::table('products')->where('category_id',$category->id)->update([
                    'category_id' => $parentId
                ]);
            }
            //Sprawdzamy czy ta kategoria jest bezpośrednim rodzicem innej kategorii
            if(Category::where('parent_id',$category->id)->get()->count() > 0){
                if($parentId === null){
                    request()->session()->flash('danger', 'Nie można usunąć kategorii głównej jeśli jest bezpośrednio rodzicem innej kategorii');
                    return redirect()->back();
                }

                DB::table('categories')->where('parent_id',$category->id)->update([
                    'parent_id' => $parentId
                ]);
            }


            request()->session()->flash('success', 'Usunięto kategorię!');
            return redirect()->route('adminCategoryList');
        }
    }
}

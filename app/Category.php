<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function child(){
        return $this->hasMany('App\Category','parent_id');
    }
    public function allSubCategories(){
        return $this->hasMany('App\Category','parent_id','id')->with('allSubCategories');
    }
    public function parent(){
        return $this->belongsTo('App\Category','parent_id');
    }
    public function getAllChildreens(){
        $tmp_child = $this->allSubCategories;
        if($tmp_child->isNotEmpty()){ //jesli ma podkategorie

        }
    }
    public static function createAlias($name){
        return trim(preg_replace('/\W+/', '-', strtolower(trim($name))));
    }
    public function getTree(){
        $tree = [];
        $category = $this;
        $tree[] = $category;
        if(!$this->parent_id) return $tree;
        while($category){
            $category = Category::find($category->parent_id);
            if($category) $tree[] = $category;
        }
        return array_reverse($tree);
    }

    public function getUrl(){
        return "/category/{$this->alias},{$this->id}";
    }
}

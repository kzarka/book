<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller
{

    public function load(Request $request)
    {
        $categories = Categories::select('*')->get();
        foreach ($categories as $category) {
            $category->parent_name = Categories::getName($category->parent_id);
        }
        $result['data'] = $categories;
        return json_encode($result);
    }

    public function delete($id)
    {
        $class = Classes::find($id);
        if(!$class) {
            return 'false';
        }
        $class->delete();
        return 'true';
    }

    public function loadParents(Request $request) {
        $parent = Categories::select('id', 'name', 'parent_id')
            ->where('parent_id', 0)
            ->get();
        return ($parent);
    }
}

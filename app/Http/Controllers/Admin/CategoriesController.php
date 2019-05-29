<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parent = Categories::select('id', 'name', 'parent_id')
            ->where('parent_id', 0)
            ->get();
        return view('admin.category.index', ['parent' => $parent]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $category = Categories::find($id);
        //validate
        if ($request->parent_id) {
            $category->parent_id = $request->parent_id;
        } else $category->parent_id = 0;
        $category->fill($data);
        $category->save();
        return 'true';
    }

    public function create(Request $request)
    {
        $category = new Categories();
        $data = $request->all();
        //validate
        $category->fill($data);
        if ($request->parent_id) {
            $category->parent_id = $request->parent_id;
        }
        $category->save();
        return 'true';
    }

    public function load(Request $request)
    {
        $categories = Categories::select('*')->get();
        foreach ($categories as $category) {
            $category->parent_name = Categories::getName($category->id);
        }
        $result['data'] = $categories;
        return json_encode($result);
    }

    public function delete($id)
    {
        $category = Categories::find($id);
        if(!$category) {

            return 'false';
        }
        Categories::where('parent_id', id)
          ->update(['parent_id' => 0]);
        $category->delete();

        return 'true';
    }
}

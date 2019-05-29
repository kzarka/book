<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostsCategories;
use App\Models\Categories;

class CategoriesController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $categoryIdentity = null)
    {
        $breadcrumb = [
            'name' => 'category_list',
            'object' => ''
        ];
        if (!$categoryIdentity) {
            $categories = Categories::where('parent_id', 0);
            return view('category.index', [
                'categories' => $categories,
                'breadcrumb' => $breadcrumb
            ]);
        }
        $breadcrumb = [
            'name' => 'category',
            'object' => ''
        ];
        $category = new Categories();
        if (is_numeric($categoryIdentity)) {
            $category = $category->where('id', $categoryIdentity)->first();
        } else {
            $category = $category->where('slug', $categoryIdentity)->first();
        }
        if (!$category) {
            return view('category.index', [
                'breadcrumb' => $breadcrumb
            ]);
        }
    	$collections = PostsCategories::where('category_id', $category->id)->get();
        foreach ($collections as $collection) {
            //$index = preg_replace('/\s/', '', $collection->created_at);
            //$collection->time = strtolower($index);
        }
        
        $breadcrumb = [
            'name' => 'category',
            'object' => $category
        ];
        return view('category.index', [
            'collections' => $collections,
            'category' => $category,
            'breadcrumb' => $breadcrumb
        ]);
    }
}

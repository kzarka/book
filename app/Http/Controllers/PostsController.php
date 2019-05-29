<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Event;
use Illuminate\Http\Request;
use App\Models\PostsCategories;
use App\Models\Categories;
use App\Models\Posts;

class PostsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $categoryIdentity = null, $postIdentity = null)
    {
        if (!$categoryIdentity) {
            return redirect()->route('category', '');
        }

        $category = new Categories();
        if (is_numeric($categoryIdentity)) {
            $category = $category->where('id', $categoryIdentity)->first();
        } else {
            $category = $category->where('slug', $categoryIdentity)->first();
        }
        if (!$category && $categoryIdentity != Categories::DEFAULT_CATEGORY) {
            return redirect()->route('category', '');
        }

        $post = new Posts();
        if (is_numeric($postIdentity)) {
            $post = $post->where('id', $postIdentity)->first();
        } else {
            $post = $post->where('slug', $postIdentity)->first();
        }
        if ($post) {
            $post->category = $category;
            Event::fire('posts.view', $post);
        } else {
            $post['category'] = $category;
        }
        $breadcrumb = [
            'name' => 'post',
            'object' => $post
        ];
        return view('post.index', [
            'post' => $post,
            'category' => $category,
            'breadcrumb' => $breadcrumb
        ]);
    }
}

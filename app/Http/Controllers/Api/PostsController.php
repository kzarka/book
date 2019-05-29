<?php

namespace App\Http\Controllers\Api;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts;
use App\User;

class PostsController extends Controller
{

    public function load(Request $request)
    {
        if(Sentinel::getUser()->inRole('admin')) {
            $posts = Posts::select('*')->get();
        } else {
            $posts = Posts::where('author_id', Sentinel::getUser()->id)->get();
        }
        foreach ($posts as $post) {
            $post->author_name = User::getName($post->author_id);
        }
        $result['data'] = $posts;
        return json_encode($result);
    }

    public function delete($id)
    {
        $post = Posts::find($id);
        if(!$post) {
            return 'false';
        }
        PostsCategories::updateItems($post->id);
        $post->delete();
        return 'true';
    }
}

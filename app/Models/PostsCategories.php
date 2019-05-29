<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categories;
use App\Models\Posts;

class PostsCategories extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts_categories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'category_id'
    ];

    public function post() {
        return $this->hasOne('App\Models\Posts', 'id', 'post_id');
    }

    public function category() {
        return $this->hasOne('App\Models\Categories', 'id', 'category_id');
    }

    public static function updateItems($id, $categories = null) {
        if (!$categories) {
            self::where('post_id', $id)->delete();
            return true;
        }
        if(!is_array($categories)) {
            $categories = [$categories];
        }
        $current_categories = self::select('category_id')->where('post_id', $id)->get();
        foreach ($current_categories as $current_category) {
            if (!in_array($current_category['category_id'], $categories)) {
                self::where('post_id', $id)
                    ->where('category_id', $current_categories['category_id'])
                    ->delete();
            }
        }
        $current_post = self::where('post_id', $id);
        foreach ($categories as $category) {
            if($current_post->where('category_id', $category)->count() == 0) {
                self::create(['post_id' => $id, 'category_id' => $category]);
            }
        }
    }
}

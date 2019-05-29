<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Posts extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'public',
        'content',
        'slug',
        'excert',
    ];

    protected $mainColumns = [
        'id',
        'author_id',
        'title',
        'public',
        'content',
        'slug',
        'view_count',
        'created_at',
        'updated_at',
        'excert',
        'thumbnail',
        'top_image'
    ];
    const PUBLIC_POST = 1;

    /**
     * Scope a query to only include public posts.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublic($query)
    {
        return $query->where('public', self::PUBLIC_POST);
    }

    public function scopeExclude($query, ...$columns)
    {
        $value = [];
        foreach ($columns as $column) {
            $value[] = $column;
        }
        return $query->select( array_diff( $this->mainColumns,(array) $value) );
    }

    public function user() {
        return $this->belongsTo('App\User', 'author_id');
    }

    public function categories() {
        return $this->hasMany('App\Models\PostsCategories', 'post_id', 'id');
    }

    public function news() {
        return $this->hasOne('App\Models\PostsCategories', 'post_id', 'id')->where('category_id', 1);
    }

    /**
     * Get first category
     */
    public function firstCategory () {
        $category = null;
        if ($this->categories->count() !== 0 ) {
            $category = $this->categories->first()->category;
        }
        return $category;
    }

    /**
     * Get first category name
     */
    public function firstCategoryName () {
        $category = $this->firstCategory();
        if ($category) return $category->name;
        return Categories::DEFAULT_CATEGORY;
    }

    public function firstCategorySlug () {
        $category = $this->firstCategory();
        if ($category) return ($category->slug ?: $category->id);
        return Categories::DEFAULT_CATEGORY;
    }

    /**
     * Build url
     */
    public function url() {
        $category_identity = Categories::DEFAULT_CATEGORY;
        $category = $this->firstCategory();
        if ($category) {
            $category_identity = $category->slug ?: $category->id;
        }
        return route('post', [
            'categoryIdentity' =>  $category_identity,
            'postIdentity' => $this->slug ?: $this->id,
        ]);
    } 

    /**
     * Get lastest posts
     */
    public static function getLastestPosts($limit = 5) {
        $collection = self::public()->exclude('content')
        ->orderBy('created_at', 'DESC')
        ->get();
        $collection = $collection->filter(function ($item, $key) {
            if(!$item->news) return $item;
        })->take($limit);

        return $collection;
    }

    /**
     * Get lastest posts
     */
    public static function getPopularPosts($limit = 3) {
        $collection = self::public()->exclude('content')->orderBy('view_count')->get();
        $collection = $collection->filter(function ($item, $key) {
            if(!$item->news) return $item;
        })->take($limit);

        return $collection;
    }

    public static function getPostsByCategory($id = '1', $limit = 3) {
        $category = Categories::find($id);
        if(!$category) return false;
        $posts = $category->posts;
        $posts = $posts->filter(function ($item, $key) {
            if($item->post->public == 1) return $item;
        })->take($limit);
        return $posts;
    }

    public static function getRandomPosts ($category_id = null, $current_post_id = null, $limit = 5) {
        $posts = self::public()->exclude('content')->inRandomOrder()->get();
        $category = null;
        if($category_id) {
            $category = Categories::find($category_id);
        }
        if($category) {
            $posts = $category->posts;
            if($current_post_id) {
                $posts = $posts->where('post_id', '<>', $current_post_id);
            }
            $result = new Collection();
            foreach ($posts as $post) {
                $result->push($post->post);
            }
            $posts = $result->where('public', self::PUBLIC_POST);
        }
        return $posts->filter(function ($item, $key) {
            if(!$item->news) return $item;
        })->take($limit);
    }

    public function getCreatedAtAttribute($value) {
        $dateString = \Carbon\Carbon::parse($value)->format('d M, Y');
        $dateString = str_replace("Jan", "Tháng 1", $dateString);
        $dateString = str_replace("Feb", "Tháng 2", $dateString);
        $dateString = str_replace("Mar", "Tháng 3", $dateString);
        $dateString = str_replace("Apr", "Tháng 4", $dateString);
        $dateString = str_replace("May", "Tháng 5", $dateString);
        $dateString = str_replace("Jun", "Tháng 6", $dateString);
        $dateString = str_replace("Jul", "Tháng 7", $dateString);
        $dateString = str_replace("Aug", "Tháng 8", $dateString);
        $dateString = str_replace("Sep", "Tháng 9", $dateString);
        $dateString = str_replace("Oct", "Tháng 10", $dateString);
        $dateString = str_replace("Nov", "Tháng 11", $dateString);
        $dateString = str_replace("Dec", "Tháng 12", $dateString);
        return $dateString;
    }

    public function getAuthorName() {
        return User::getName($this->author_id);
    }
}

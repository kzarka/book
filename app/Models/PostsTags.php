<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class PostsTags extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts_tags';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'tag_id'
    ];
}

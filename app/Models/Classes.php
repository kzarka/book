<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'classes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'enable',
        'desc_normal',
        'desc_awaken',
        'has_awk',
        'normal_video',
        'awaken_video',
        'normal_img',
        'awaken_img'
    ];
}

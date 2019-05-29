<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ImagesSetting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'images_setting';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'url',
        'default_url'
    ];

    public function getLogoUrl() {
        if($this->url) {
            return $this->url;
        }
        return $this->default_url;
    } 
}

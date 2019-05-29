<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class BossData extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bosses_data';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'data'
    ];
}

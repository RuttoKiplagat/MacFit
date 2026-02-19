<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bundle extends Model
{
    protected $table = 'bundles';
     protected $fillable = [
        'name',
        'start_time',
        'duration',
        'category_id',
        'description'
    ];
}

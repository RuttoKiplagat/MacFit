<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'start_time',
        'duration',
        'description',
        'category_id'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class subscription extends Model
{   protected $table = 'subscriptions';
    protected $fillable = [
        'user_id',
        'bundle_id',
        'value'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function bundle(){
        return $this->belongsTo(Bundle::class);
    }
}

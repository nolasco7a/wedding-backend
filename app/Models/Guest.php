<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Guest extends Model
{
    protected $table = 'guests';
    protected $guarded = [];

    public function scopeChildren($query){
        return $query->where('category', 2);
    }

    public function scopeParents($query){
        return $query->where('category', 1);
    }

}

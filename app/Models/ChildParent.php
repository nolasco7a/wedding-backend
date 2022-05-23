<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ChildParent extends Model
{
    protected $table = 'child_parents';

    public function scopeChildren($query){
        return $query->where('category', 2);
    }
}

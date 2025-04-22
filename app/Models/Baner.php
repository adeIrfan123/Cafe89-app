<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Baner extends Model
{
    //
    protected $guarded = ['id'];

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = strip_tags($value);
    }
}

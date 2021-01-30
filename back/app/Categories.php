<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    public function items()
    {
        return $this->hasMany('App\Items');
    }

    protected $table = "categories";
    protected $fillable = ["name", "image"];
    // public $timestamps = false;

}

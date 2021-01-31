<?php

namespace App;

use App\Items;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    public function items()
    {
        return $this->hasMany(Items::class);
    }

    protected $table = "categories";
    protected $fillable = ["name", "image"];
    // public $timestamps = false;

}

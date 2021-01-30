<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Categories');
    }
    protected $table = "items";
    protected $fillable = ["name", "image", "description", "price", "categoryID"];
    // public $timestamps = false;

}

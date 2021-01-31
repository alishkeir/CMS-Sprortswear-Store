<?php

namespace App;

use App\Categories;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
    protected $table = "items";
    protected $fillable = ["name", "image", "description", "price", "categoryID"];
    // public $timestamps = false;

}

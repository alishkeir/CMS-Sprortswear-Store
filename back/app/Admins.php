<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admins extends Model
{
  protected $table = "admins";
  protected $fillable = ["name", "username", "email", "password"];
  // public $timestamps = false;
}

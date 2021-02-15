<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Items;


class ItemController extends Controller
{
  public function index()
  {
      return Items::paginate(10);
  }  


  public function show($id)
  {
      return Items::where("id", $id)->first();
  }


}

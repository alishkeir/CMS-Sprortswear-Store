<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use JWTAuth;


class CategoriesController extends Controller
{
  protected $user;

  public function __construct()
  {
      $this->user = JWTAuth::parseToken()->authenticate();
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Categories::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'image' => 'bail|required|mimes:jpeg,png,jpg,gif,svg|max:5000',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);

        } else {

            $data = $request->all();
            $image = $request->file('image');
            $name = time() . '_' . $image->getClientOriginalName();
            $path = $request->file('image')->storeAs('', $name, 'public');
            if ($path) {
                $category = new Categories();

                $category->name = $data['name'];
                $category->image = $path;
                $category->save();
                return response()->json(['status' => 200, 'category' => $category]);
            } else {

                return response()->json(['status' => 500, 'error' => "couldnt upload image"]);

            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Categories::where("id", $id)->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'max:255',

            'image' => 'bail|mimes:jpeg,png,jpg,gif,svg|max:5000',

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        } else {
            $data = $request->all();

            $image = $request->file('image');

            if ($request->image) {
                $name = time() . '_' . $image->getClientOriginalName();
                $path = $request->file('image')->storeAs('', $name, 'public');}

            $category = Categories::where('id', $id)->first();

            if ($request->name) {
                $category->name = $data['name'];
            }

            if ($request->image) {
                if ($path) {
                    $category->image = $data['image'];
                }
            }
            $category->save();
            return response()->json(['status' => 200, 'item' => $category]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Categories::where("id", $id)->delete();
    }
}

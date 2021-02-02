<?php

namespace App\Http\Controllers;

use App\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use JWTAuth;


class ItemsController extends Controller
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
        return Items::paginate(10);
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
            'description' => 'required',
            'price' => 'required|numeric|min:1',
            'image' => 'bail|required|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'categoryID' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        } else {

            $data = $request->all();
            $image = $request->file('image');
            $name = time() . '_' . $image->getClientOriginalName();
            $path = $request->file('image')->storeAs('', $name, 'public');
            if ($path) {
                $item = new Items();
                $item->name = $data['name'];
                $item->image = $path;
                $item->description = $data['description'];
                $item->price = $data['price'];
                $item->categoryID = $data['categoryID'];
                $item->save();
                return response()->json(['status' => 200, 'item' => $item]);

            } else {

                return response()->json(['status' => 500, 'error' => "Image Upload Failed"]);

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
        return Items::where("id", $id)->first();
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
            'price' => 'numeric|min:1',
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

            $item = Items::where('id', $id)->first();

            if ($request->name) {
                $item->name = $data['name'];
            }

            if ($request->description) {
                $item->description = $data['description'];
            }

            if ($request->price) {
                $item->price = $data['price'];
            }

            if ($request->categoryID) {
                $item->categoryID = $data['categoryID'];
            }

            if ($request->image) {
                if ($path) {
                    $item->image = $data['image'];
                }
            }
            $item->save();
            return response()->json(['status' => 200, 'item' => $item]);
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
        Items::where("id", $id)->delete();
    }
}

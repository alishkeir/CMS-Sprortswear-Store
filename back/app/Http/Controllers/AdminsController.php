<?php

namespace App\Http\Controllers;

use App\Admins;
use App\Http\Resources\Admins as AdminsResource;
use Illuminate\Http\Request;
use JWTAuth;


class AdminsController extends Controller
{

    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }


    public function index()
    {
        return AdminsResource::collection(Admins::paginate(5));

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
        $request->validate([
            "username" => 'required',
            "email" => 'required',
            "password" => 'required',
        ]);
        $validator = \Validator::make($request->all(), [
            'username' => 'required|unique:admins',
            'email' => 'required|unique:admins',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }

        $admin = new Admins([
            "username" => $request->username,
            "email" => $request->email,
            "password" => bcrypt($request->password),
        ]);
        $admin->save();
        return response()->json(["data" => "admin created"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

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
        $request->validate([
            "username" => "required",
            "email" => "required",
            "password" => "required",
        ]);

        $admin = Admins::findOrFail($id);

        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->save();
        return response()->json(["data" => "admin edited"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = Admins::findOrFail($id);
        $admin->destroy($id);

        return response()->json(['data' => "deleted"]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Messages::paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {

    // }

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
            'title' => 'required',
            'content' => 'required',
            'email' => 'required|email:rfc,dns|max:255',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        } else {
            $data = $request->all();
            $message = new Messages();

            $message->name = $data['name'];
            $message->title = $data['title'];
            $message->content = $data['content'];
            $message->email = $data['email'];
            $message->save();
            return response()->json(['status' => 200, 'message' => $message]);

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
        return Messages::where("id", $id)->first();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }
}

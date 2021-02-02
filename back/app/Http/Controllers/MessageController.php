<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
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
            $message = new Message();

            $message->name = $data['name'];
            $message->title = $data['title'];
            $message->content = $data['content'];
            $message->email = $data['email'];
            $message->save();
            return response()->json(['status' => 200, 'message' => $message]);

        }
    }
}

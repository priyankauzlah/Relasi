<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    //
    public function createUser (Request $request){
        $data = $request ->all();
        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->save();

        $user->phone()->create(
            [
                'phone' => $data['phone']
            ]);
            $user->phone;

        $status = "success";
        return response()->json(compact('user', 'status'), 200);
    }

    public function getUser($id){
        $user = User::find($id);
        $user->phone;
        $status = "success";
        return response()-> json(compact('user', 'status'), 200);
    }

    public function updateUser($id, Request $request){
        $data = $request->all();
        $user = User::find($id);

        $validator = Validator::make(
            $data, [
                'name' => 'required|string|max:100',
                'email' => 'required|email|unique:users,email,'.$id,
                'password' => 'required|string|min:6',
            ]
        );
        
        
        if($validator->fails()){
            $error = $validator->errors();
            return response()->json(compact('error'), 401);
        }

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->save();
        $user->phone()->phone = $data['phone'];
        $user->push;
        $status = "success";
        return response()->json(compact('user', 'status'), 200);
    }

    public function deteleUser($id){
        $user = User::find($id);
        $user->phone->delete();
        $user->delete();
        $status = "success";
        return response()-> json(compact('user', 'status'), 200);
    }
}
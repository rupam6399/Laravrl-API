<?php

namespace App\Http\Controllers;

use App\ApiController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5|max:12'
        ]);
        $users = new User(); 
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->password = Hash::make($request->input('password'));

        $users->save();
        return response()->json($users);
    }


    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        $users = User::where('email', $request->email)->first();
        // if(!$users || !Hash::check($request->password, $users->password)){
        if(!$users){
            return response([
                'message'=>'The provided credentials are incorrect.'
            ], 401);
        }
        else{        // $token = $user->createToken('mytoken')->plainTextToken;
            return response([
                'message' => 'Login Scces',
                'user'=>$users,
                // 'token'=>$token
            ], 201);
        }
    }

    public function delete($id)
    {
        $users= User::where('id',$id)->first();
        $result = $users->delete();
        if($result)
        {
            return ["result"=>"$id, Deleted successfully"];
            // return "found";
        }
        else
        {
            return ["result"=>"$id, Not Found"];
            // return "not found";
        }
    }
    public function display()
    {
        $users = User::all();
        return response()->json(['users'=>$users]);
    }

}
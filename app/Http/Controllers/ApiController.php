<?php

namespace App\Http\Controllers;

use App\Models\Vendor;

use App\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    // public $user;

    // public function __construct(User $user)
    // {
    //     $this->user = $users;
    // }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5|max:12'
        ]);
        $vendors = new Vendor(); 
        $vendors->name = $request->input('name');
        $vendors->email = $request->input('email');
        $vendors->password = Hash::make($request->input('password'));

        $vendors->save();
        return response()->json($vendors);
    }


    public function check(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        $vendors = Vendor::where('email', $request->email)->first();
        // if(!$users || !Hash::check($request->password, $users->password)){
        if(!$vendors){
            return response([
                'message'=>'The provided credentials are incorrect.'
            ], 401);
        }
        else{        // $token = $user->createToken('mytoken')->plainTextToken;
            $users = User::all();
            return response()->json(['users'=>$users]); 
        }
    }

    
    public function remove($id)
    {
        $vendors= Vendor::where('id',$id)->first();
        $result = $vendors->remove();
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
    
    public function update(Request $request, $id)
    {
        $vendors= Vendor::find($request->$id);
        $vendors->name = $request->name;
        $vendors->email = $request->email;
        $vendors->password = $request->password;
        $result = $vendor->save();
        if($result){
            return "hello";   
        }
        else
        {
            return "not";
        }      
    }   
}

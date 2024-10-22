<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function index(){
        return User::all();
    }
    function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        $user= new User();
        $user->name= request('name');
        $user->email= request('email');
        $user->password= Hash::make(request('password'));

        $user->save();

        return response()->json(['message'=>'User registered Successfully'],201);
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user= User::where('email',$request->email)->first();
        if(!$user || !Hash::check(request('password'),$user->password)){
            return response()->json(['message'=>'invalid email or password'],401);
        }
        else{
            return response()->json(['message'=>'User Login Successfully'],200);
        }
    }
    public function edit(request $request,$id){
        $request->validate([
            'name' => 'sometimes|required',
            'email' => 'sometimes|required|email|unique:users',
            'password' => 'sometimes|required',
        ]);
        $user= User::find($id);
        $user->update($request->all());
        return $user;
    }
    public function delete($id){
        User::destroy($id);
        return response()->json(['message'=>'User deleted Successfully'],200);
    }

    public function show($id){
     return User::find($id);
    }

    public function search($name){
        return User::where('name','like','%'.$name.'%')->get();
    }
}

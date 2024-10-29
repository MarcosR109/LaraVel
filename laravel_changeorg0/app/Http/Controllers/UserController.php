<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
class UserController extends Controller
{
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6|max:255|string',
            'c_password' => 'required|same:password',
        ]);
        if ($validation->fails()) {
            return response()->json($validation->messages(), 400);
        }
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);
        return response()->json(['message' => 'User Created', 'data' => $user], 200);
    }

    public function show(User $user)
    {
        return response()->json(['message' => '', 'data' => $user], 200);
    }
    public function show_address(User $user){
        $alldata = array_merge($user->address->attributesToArray(),$user->attributesToArray());
        return response()->json(['message' => 'Dirección encontrada', 'data' => $alldata], 200);
    }
}

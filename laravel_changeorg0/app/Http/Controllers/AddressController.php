<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $address=null;
        $validation = Validator::make($request->all(), [
            'country' => 'required|string|max:255',
            'zipcode' => 'required|string|max:5',
            'email' => 'required|string|email|max:255|exists:users,email',
        ]);
        if ($validation->fails()){
            return response()->json($validation->messages(), 400);
        }
        $user = User::where('email', request('email'))->first();
        if($user->email){
            $address = Address::create([
                'country' => $request->get('country'),
                'zipcode' => $request->get('zipcode'),
                'user_id' => $user->id,
            ]);
        }
        if($address){
        return response()->json(['message' => 'Address created', 'data' => $address], 200);
        }
        return response()->json(['message' => $user], 400);
    }

    public function show(Address $address)
    {
        return response()->json(['message' => '', 'data' => $address], 200);
    }
    public function show_user(Address $address){
            $alldata = array_merge($address->attributesToArray(),$address->user->attributesToArray());
        return response()->json(['message' => 'Usuario encontrado.', 'data' => $alldata], 200);

    }
}

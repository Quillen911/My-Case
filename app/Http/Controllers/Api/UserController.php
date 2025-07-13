<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\UserValidation\ShowUserRequest;
use App\Http\Requests\UserValidation\UpdateUserRequest;
use App\Http\Requests\UserValidation\AdminVerifyRequest;
use App\Http\Requests\UserValidation\BulkDeleteUserRequest;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }

    public function show($id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json(['message' => 'Kullanıcı bulunamadı'],404);
        }
        return response()->json($user);
    }

    public function store(ShowUserRequest $request)
    {
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return response()->json($user,201);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json(['message' => 'Kullanıcı bulunamadı'],404); 
        }

        $user->update($request->only(['username', 'email']));
        if($request->filled('password')){
            $user->password = Hash::make($request->password);
            $user->save();
        }

        return response->json($user);
    }
    public function destroy($id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json(['message' => 'Kullanıcı bulunamadı'], 404);
        }
        user->delete();
        return response()->json(['message' => 'Kullanıcı silindi']);
    }

}

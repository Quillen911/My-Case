<?php
namespace App\Http\Controllers;

use App\Http\Requests\UserValidation\ShowUserRequest;
use App\Http\Requests\UserValidation\UpdateUserRequest;
use App\Http\Requests\UserValidation\AdminVerifyRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    public function addUser()
    {
        return view('user.addUser');
    }

    public function postUser(ShowUserRequest $request)
    {
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return view('user.addUser', ['success' => 'Kullanıcı başarıyla eklendi.']);
    }

    public function listUser()
    {
        $user=User::all();
        return view('user.listUser', compact('user'));
    }

    public function editVerify($id)
    {
        return view('user.editVerify', ['id' => $id]);
    }

    public function postEditVerify(AdminVerifyRequest $request, $id)
    {
        $user = Auth::user();
        if (Hash::check($request->password, $user->password)) {
            return redirect()->route('editUser', ['id' => $id]);
        }
        return back()->withErrors(['password' => 'Şifre yanlış!']);
    }
    //edit
    public function editUser($id){
        $user = \App\Models\User::findOrFail($id);
        return view('user.editUser',compact('user'));
    }
    public function updateUser(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'username' => $request->username,
            'email' => $request->email,
        ]);
        return view('user.editUser', [
            'user' => $user,
            'success' => 'Kullanıcı başarıyla güncellendi.',
        ]);
    }

    public function deleteListUser()
    {
        $user = \App\Models\User::onlyTrashed()->get();
        return view('user.deleteListUser', compact('user'));
    }

    public function bulkDeleteUser(BulkDeleteUserRequest $request)
    {
        $ids = $request->input('user_ids', []);
        $user = User::all();
        $error = null;
        $success = null;
        User::whereIn('id', $ids)->delete(); 
        $success = 'Seçilen kullanıcılar silindi.';
        $user = User::all();
        return view('user.listUser', compact('user', 'error', 'success'));
    }
}
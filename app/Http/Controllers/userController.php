<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class userController extends Controller{
    public function addUser(){
        return view('user.addUser');
    }
    public function postUser(Request $request){
        $messages = [
            'username.unique' => 'Bu kullanıcı adı zaten kullanılıyor.',
            'username.alpha_num' => 'Kullanıcı adı sadece harf ve rakam içermelidir.',
            'username.regex' => 'Kullanıcı adı boşluk içeremez.',
            'email.unique' => 'Bu e-posta zaten kayıtlı.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'username.required' => 'Kullanıcı adı zorunludur.',
            'email.required' => 'E-posta zorunludur.',
            'password.required' => 'Şifre zorunludur.',
            'password.regex' => 'Şifre en az 6 karakter olmalı, bir büyük harf, bir küçük harf ve bir sayı içermelidir.'
        ];

        $validator = \Validator::make($request->all(), [
            'username' => [
                'required',
                'unique:users,username',
                'alpha_num',
                'regex:/^\S+$/'
            ],
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/'
            ]
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $firstError = null;
            if ($errors->has('username')) {
                $firstError = $errors->first('username');
            } elseif ($errors->has('email')) {
                $firstError = $errors->first('email');
            } elseif ($errors->has('password')) {
                $firstError = $errors->first('password');
            }
            return view('user.addUser', [
                'error' => $firstError,
                'success' => null,
                'old' => $request->all()
            ]);
        }

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return view('user.addUser', ['success' => 'Kullanıcı başarıyla eklendi.']);
    }
    public function listUser(){
        $user=User::all();
        return view('user.listUser', compact('user'));
    }
    public function editVerify($id){
        return view('user.editVerify', ['id' => $id]);
    }

    public function postEditVerify(Request $request, $id){
        $request->validate([
            'password' => 'required',
        ]);
        $user = Auth::user();
        if(Auth::attempt(['email' => $user->email, 'password' => $request->password])){
            return redirect()->route('editUser', ['id' => $id]);
        }
        return back()->withErrors(['password' => 'Şifre yanlış!']);
    }

    public function editUser($id){
        $user = \App\Models\User::findOrFail($id);
        return view('user.editUser',compact('user'));
    }
    public function updateUser(Request $request, $id){
        $user = \App\Models\User::findOrFail($id);

        $messages = [
            'username.unique' => 'Bu kullanıcı adı zaten kullanılıyor.',
            'username.alpha_num' => 'Kullanıcı adı sadece harf ve rakam içermelidir.',
            'username.regex' => 'Kullanıcı adı boşluk içeremez.',
            'email.unique' => 'Bu e-posta zaten kayıtlı.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'username.required' => 'Kullanıcı adı zorunludur.',
            'email.required' => 'E-posta zorunludur.',
        ];

        $validator = \Validator::make($request->all(), [
            'username' => [
                'required',
                'unique:users,username,' . $user->id,
                'alpha_num',
                'regex:/^\S+$/'
            ],
            'email' => 'required|email|unique:users,email,' . $user->id,
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $firstError = null;
            if ($errors->has('username')) {
                $firstError = $errors->first('username');
            } elseif ($errors->has('email')) {
                $firstError = $errors->first('email');
            }
            return view('user.editUser', [
                'user' => $user,
                'error' => $firstError,
                'success' => null,
            ]);
        }

        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        return view('user.editUser', [
            'user' => $user,
            'success' => 'Kullanıcı başarıyla güncellendi.',
        ]);
    }
    public function deleteListUser(){
        $user = \App\Models\User::onlyTrashed()->get();
        return view('user.deleteListUser', compact('user'));
    }
    
    public function bulkDeleteUser(Request $request)
    {
        $ids = $request->input('user_ids', []);
        $user = User::all();
        $error = null;
        $success = null;
        if (empty($ids)) {
            $error = 'Lütfen silmek için en az bir kullanıcı seçin.';
            return view('user.listUser', compact('user', 'error', 'success'));
        }
        if (!empty($ids)) {
            User::whereIn('id', $ids)->delete(); // Soft delete
            $success = 'Seçilen kullanıcılar silindi.';
        }
        $user = User::all(); // Silme sonrası güncel liste
        return view('user.listUser', compact('user', 'error', 'success'));
    }
}
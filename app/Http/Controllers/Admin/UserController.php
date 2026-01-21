<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role','!=', 'admin')->get(); 
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view ('admin.users.create');
    }

    public function store(Request $request){
$request->validate([
    'name' => 'required', 'email' => 'required|email|unique:users', 'password' => 'required|min:6', 'role' => 'required|in:user,staff',
]);

 User::create([
            'name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password), 'role' => $request->role, 'phone' => $request->phone,
        ]);

        return redirect()->route('users.index')->with('berhasil', 'data berhasil di buat');
    }

    public function edit(User $user){
    return view('admin.users.edit', compact('user'));
}

    public function update(Request $request, User $user){
          $request->validate([
            'name' => 'required',
            'role' => 'required|in:user,staff',
        ]);

        $data = $request->only('name','role','phone');

        if ($request->password) {
            $data['password'] = Hash::make($request->password);

        }

        $user->update($data);

        return redirect()->route('users.index')->with('success','User berhasil diupdate');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success','User dihapus');
    
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $data['users'] = User::all();
        return view('user.index', $data);
    }

    public function create(){
        $data['roles'] = Role::pluck('name', 'name')->all();
        return view('user.create', $data);
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:20',
            'role_name' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->syncRoles($request->role_name);

        $notification = array(
            'message' => "Data User berhasil ditambahkan!",
            'alert-type' => 'success'
        );

        $notifications = array(
            'message' => "Data User gagal ditambahkan!",
            'alert-type' => 'error'
        );

        if($request->save == true) {
            return redirect()->route('user')->with($notification);
        } else {
            return redirect()->route('user.create')->with($notifications);
        }

    }

    public function edit(User $users, string $id){
        $users = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $users->roles->pluck('name', 'name')->all();
        return view('user.edit', [
            'users' => $users,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }

    public function update(Request $request, string $id){
        $user = User::find($id);

        $request->validate([
            'name' => 'required|string',
            'password' => 'nullable|string|min:8',
            'roles' => 'required'
        ]);
        
        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if(!empty($request->password)){
            $data += [
                'password' => Hash::make($request->password),
            ];
        }
        User::where('id', $id)->update($data);
        $user->syncRoles($request->roles);

        $notification = array(
            'message' => "Data User berhasil diperbaharui!",
            'alert-type' => 'success'
        );

        $notifications = array(
            'message' => "Data User gagal diperbaharui!",
            'alert-type' => 'error'
        );

        if($request->save == true) {
            return redirect()->route('user')->with($notification);
        } else {
            return redirect()->route('user.edit')->with($notifications);
        }
    }

    public function destroy(string $id){
        $user = User::find($id);
        $user->delete();

        $notification = array(
            'message' => "Data User berhasil dihapus!",
            'alert-type' => 'success'
        );

        return redirect()->route('user')->with($notification);
    }

    public function search(Request $request){

        $search = $request->search;

        $users = User::where(function($query) use ($search){
            
            $query->where('name', 'like', "%$search%")
            ->orWhere('email', 'like', "%$search%");
        })->get();

        
        $rolenames = Role::where(function($query) use ($search){
            
            $query->where('name', 'like', "%$search%");
        })->get();

        return view('user.index', compact('users','rolenames','search'));
    }   
}
 
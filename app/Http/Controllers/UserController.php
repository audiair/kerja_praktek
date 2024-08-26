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
            'roles' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->syncRoles($request->roles);

        if($request->save == true) {
            return redirect()->route('user');
        } else {
            return redirect()->route('user.create');
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
            'email' => 'required|email',
            'password' => 'nullable|string|min:8',
            'roles' => 'required'
        ]);
        
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        if(!empty($request->password)){
            $data += [
                'password' => Hash::make($request->password),
            ];
        }
        User::where('id', $id)->update($data);
        $user->syncRoles($request->roles);

        return redirect()->route('user');
    }

    public function destroy(string $id){
        $user = User::find($id);
        $user->delete();

        return redirect()->route('user');
    }

    public function search(Request $request){

        $search = $request->search;

        $users = User::where(function($query) use ($search){

            $query->where('name', 'like', "%$search%")
            ->orWhere('email', 'like', "%$search%");
        })->get();

        return view('user.index', compact('users','search'));
    }
}

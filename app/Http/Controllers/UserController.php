<?php

namespace App\Http\Controllers;

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
        $data['users'] = User::all();
        return view('user.create' ,$data);
    }

    public function store(Request $request){

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        User::create($validated);

        if($request->save == true) {
            return redirect()->route('user');
        } else {
            return redirect()->route('user.create');
        }
    }

    public function edit(string $id){
        $data['users'] = User::find($id);
        return view('user.edit', $data);
    }

    public function update(Request $request, string $id){
        $user = User::find($id);

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        
        User::where('id', $id)->update($validated);

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

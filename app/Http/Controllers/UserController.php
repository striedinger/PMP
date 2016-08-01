<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\UserRepository;

class UserController extends Controller
{

	protected $users;

    public function __construct(UserRepository $users){
    	$this->middleware('auth');
    	$this->users = $users;
    }

    public function index(Request $request){
    	$users = $this->users->all();
    	return view('users.index', [
    		'users' => $users
    	]);
    }

    public function update(Request $request, $id){
        if($user = $this->users->forId($id)){
            if($request->isMethod('post')){
                $this->validate($request, [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users,email,'.$id,
                    'phone' => 'required|min:7|numeric'
                ]);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->save();
                $request->session()->flash('status', 'El usuario ha sido actualizado');
                return redirect('/users/update/' . $user->id);
            }
            return view('users.update', [
                'user' => $user
            ]);
        }else{
            abort(404);
        }
    }
}

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
        $this->middleware('role:admin');
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
                $user->expiration = $request->expiration;
                $user->save();
                $request->session()->flash('status', 'El usuario ha sido actualizado');
                return redirect('/users/update/' . $user->id);
            }
            $plans = \App\Plan::lists('name', 'id');
            return view('users.update', [
                'user' => $user,
                'plans' => $plans
            ]);
        }else{
            abort(404);
        }
    }

    public function delete(Request $request, $id){
        if($user = $this->users->forId($id)){
            if($request->user()->isAdmin()){
                $user->delete();
                $request->session()->flash('status', 'El usuario ha sido eliminado');
                return redirect('/users/');
            }else{
                abort(403, 'No autorizado');
            }
        }else{
            abort(404);
        }
    }
}

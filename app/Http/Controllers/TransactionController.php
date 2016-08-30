<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Repositories\UserRepository;

class TransactionController extends Controller
{

	protected $users;

	public function __construct(UserRepository $users){
		$this->middleware('auth');
        $this->middleware('role:admin');
        $this->users = $users;
	}

    public function create(Request $request, $id){
    	if($user = $this->users->forId($id)){
    		$user->adminTransactions()->create([
    			'user_id' => $id,
    			'plan_id' => $request->plan_id
    		]);
    		$request->session()->flash('status', 'Se ha agregado la subscripcion al usuario.');
    		return redirect('/users/update/' . $user->id);
    	}else{
    		abort(404);
    	}
    }
}

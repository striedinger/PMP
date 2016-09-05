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
            $plan = \App\Plan::find($id);
            if(strtotime($user->expiration) <= date("Y-m-d")){
                $date = new \DateTime();
                $date->modify('+' . $plan->duration . ' days');
                $new_expiration = $date->format('Y-m-d');
            }else{
                $date = new \DateTime($user->expiration);
                $date->modify('+' . $plan->duration . ' days');
                $new_expiration = $date->format('Y-m-d');
            }
            $user->expiration = $new_expiration;
            $user->save();
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

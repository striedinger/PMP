<?php

namespace App\Repositories;

use App\Session;

class SessionRepository{
	public function all(){
		return Session::paginate(50);
	}

	public function forUser($id){
		return Session::where('user_id', $id)->paginate(50);
	}

	public function forId($id){
		return Session::find($id);
	}

}
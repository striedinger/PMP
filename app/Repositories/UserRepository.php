<?php

namespace App\Repositories;

use App\User;

class UserRepository{
	public function all(){
		return User::paginate(50);
	}

	public function forId($id){
		return User::find($id);
	}
}
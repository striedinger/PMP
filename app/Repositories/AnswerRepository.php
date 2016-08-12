<?php

namespace App\Repositories;

use App\Answer;

class AnswerRepository{
	public function all(){
		return Answer::paginate(50);
	}

	public function forId($id){
		return Answer::find($id);
	}

	public function forSession($id){
		return Answer::where(['session_id' => $id])->get();
	}

	public function forSessionMarked($id){
		return Answer::where(['session_id' => $id, 'marked' => true])->get();
	}
}
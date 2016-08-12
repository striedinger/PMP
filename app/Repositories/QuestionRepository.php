<?php

namespace App\Repositories;

use App\Question;

class QuestionRepository{
	public function all(){
		return Question::paginate(20);
	}

	public function forId($id){
		return Question::find($id);
	}
}
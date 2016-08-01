<?php

namespace App\Repositories;

use App\Exam;

class ExamRepository{
	public function all(){
		return Exam::paginate(50);
	}

	public function forId($id){
		return Exam::find($id);
	}
}
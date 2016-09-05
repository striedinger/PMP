<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Repositories\ExamRepository;

use App\Repositories\SessionRepository;

class SessionController extends Controller
{

	public function __construct(ExamRepository $exams, SessionRepository $sessions){
		$this->middleware('auth');
		$this->exams = $exams;
		$this->sessions = $sessions;
	}

    public function create(Request $request, $id){
    	if($exam = $this->exams->forId($id)){
    		$time = $exam->duration * 60;
    		$session = $request->user()->sessions()->create([
    			'exam_id' => $exam->id,
    			'active' => true,
    			'time' => $time
    		]);
    		return redirect('/sessions/' . $session->id);
    	}else{
    		abort(404);
    	}
    }

    public function update(Request $request, $id){
    	if($session = $this->sessions->forId($id)){
    		return view('sessions.update', ['session' => $session]);
    	}else{
    		abort(404);
    	}
    }
}

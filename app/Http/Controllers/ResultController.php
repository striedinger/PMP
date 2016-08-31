<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Repositories\SessionRepository;

use App\Repositories\AnswerRepository;

class ResultController extends Controller
{

	protected $answers;
	protected $sessions;

	public function __construct(AnswerRepository $answers, SessionRepository $sessions){
		$this->sessions = $sessions;
		$this->answers = $answers;
        $this->middleware('auth');
	}

	public function index(Request $request){
        if($request->user()->isAdmin()){
            $sessions = $this->sessions->all();
        }else{
            $sessions = $this->sessions->forUser($request->user()->id);
        }
		return view('results.index', ['sessions' => $sessions]);
	}

    public function view(Request $request, $id){
    	if($session = $this->sessions->forId($id)){
    		$answers = $this->answers->forSession($session->id);
            $correct = $answers->reject(function($answer){
                return $answer->answer != $answer->question->answer;
            });
            $wrong = $answers->reject(function($answer){
                return $answer->answer == $answer->question->answer;
            });
    		return view('results.view', ['session' => $session, 'correct' => $correct, 'wrong' => $wrong]);
    	}else{
    		abort(404);
    	}
    }
}

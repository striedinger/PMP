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
            if($request->user()->isAdmin() || $session->user_id == $request->user()->id){
                $answers = $this->answers->forSession($session->id);
                $correct = $answers->reject(function($answer){
                    return $answer->answer != $answer->question->answer;
                });
                $wrong = $answers->reject(function($answer){
                    return $answer->answer == $answer->question->answer;
                });
                $subjects = array();
                foreach($wrong as $w){
                    if(!in_array($w->question->subject, $subjects)){
                        array_push($subjects, $w->question->subject);
                    }
                }
                $areas = \App\Area::all();
                $processes = \App\Process::all();
                $area_result = array();
                $area_total = array();
                foreach($areas as $area){
                //Total de preguntas por area
                    $area_all = $answers->reject(function($answer) use ($area){
                        return $answer->question->area_id != $area->id;
                    });
                    array_push($area_total, count($area_all));
                //Total de preguntas correctas por area
                    $area_correct = $area_all->reject(function($answer) use ($area){
                        return $answer->answer != $answer->question->answer;
                    });
                    array_push($area_result, count($area_correct));
                }
                $process_result = array();
                $process_total = array();
                foreach($processes as $process){
                //Total de preguntas por proceso
                    $process_all = $answers->reject(function($answer) use ($process){
                        return $answer->question->process_id != $process->id;
                    });
                    array_push($process_total, count($process_all));
                //Total de preguntas correctas por proceso
                    $process_correct = $process_all->reject(function($answer) use ($process){
                        return $answer->answer != $answer->question->answer;
                    });
                    array_push($process_result, count($process_correct));
                }
                return view('results.view', ['session' => $session, 'areas' => $areas, 'processes' => $processes,'correct' => $correct, 'wrong' => $wrong, 'area_total' => $area_total, 'area_result' => $area_result, 'process_total' => $process_total, 'process_result' => $process_result, 'subjects' => $subjects]);
            }else{
                abort(403);
            }
        }else{
          abort(404);
      }
  }
}

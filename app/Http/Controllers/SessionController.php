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
            $area = $request->area_id;
            $process = $request->process_id;
    		$session = $request->user()->sessions()->create([
    			'exam_id' => $exam->id,
    			'active' => true,
    			'time' => $time,
                'area_id' => $area,
                'process_id' => $process
    		]);
            if($exam->type=="Area"){
                $questions = \App\Question::where('area_id', $session->area_id)->inRandomOrder()->take($exam->questions)->get();
            }elseif($exam->type=="Proceso"){
                $questions = \App\Question::where('process_id', $session->process_id)->inRandomOrder()->take($exam->questions)->get();
            }else{
                $p1 = \App\Question::where('process_id', 1)->inRandomOrder()->take($exam->questions * 0.1)->get();
                $p2 = \App\Question::where('process_id', 2)->inRandomOrder()->take($exam->questions * 0.2)->get();
                $p3 = \App\Question::where('process_id', 3)->inRandomOrder()->take($exam->questions * 0.3)->get();
                $p4 = \App\Question::where('process_id', 4)->inRandomOrder()->take($exam->questions * 0.2)->get();
                $p5 = \App\Question::where('process_id', 5)->inRandomOrder()->take($exam->questions * 0.1)->get();
                $p6 = \App\Question::where('process_id', 6)->inRandomOrder()->take($exam->questions * 0.1)->get();
                $questions = $p1->merge($p2->merge($p3)->merge($p4)->merge($p5)->merge($p6));
            }
            $i = 1;
            foreach($questions as $question){
                $session->answers()->create([
                    'question_id' => $question->id,
                    'number' => $i
                ]);
                $i++;
            }
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

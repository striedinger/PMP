<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\QuestionRepository;
use App\Question;

class QuestionController extends Controller
{
    protected $questions;

    public function __construct(QuestionRepository $questions){
    	$this->middleware('auth');
    	$this->questions = $questions;
    }

    public function index(Request $request){
    	$questions = $this->questions->all();
    	return view('questions.index', [
    		'questions' => $questions
    	]);
    }

    public function create(Request $request){
        if($request->isMethod('post')){
            $this->validate($request, [
                'question' => 'required|max:255',
                'description' => 'required',
                'optionA' => 'required',
                'optionB' => 'required',
                'optionC' => 'required',
                'optionD' => 'required',
                'answer' => 'required',
                'process_id' => 'required',
                'area_id' => 'required',
            ]);
            Question::create([
                'question' => $request->question,
                'description' => $request->description,
                'optionA' => $request->optionA,
                'optionB' => $request->optionB,
                'optionC' => $request->optionC,
                'optionD' => $request->optionD,
                'answer' => $request->answer,
                'process_id' => $request->process_id,
                'area_id' => $request->area_id,
                'active' => $request->active? true: false
            ]);
            $request->session()->flash('status', 'La pregunta ha sido creada');
            return redirect('/questions');
        }
        $areas = \App\Area::lists('name', 'id');
        $processes = \App\Process::lists('name', 'id');
        return view('questions.create', [
            'areas' => $areas,
            'processes' => $processes
        ]);
    }

    public function update(Request $request, $id){
        if($question = $this->questions->forId($id)){
            if($request->isMethod('post')){
                $this->validate($request, [
                    'question' => 'required|max:255',
                    'description' => 'required',
                    'optionA' => 'required',
                    'optionB' => 'required',
                    'optionC' => 'required',
                    'optionD' => 'required',
                    'answer' => 'required',
                    'process_id' => 'required',
                    'area_id' => 'required',
                ]);
                $question->question = $request->question;
                $question->description = $request->description;
                $question->optionA = $request->optionA;
                $question->optionB = $request->optionB;
                $question->optionC = $request->optionC;
                $question->optionD = $request->optionD;
                $question->answer = $request->answer;
                $question->process_id = $request->process_id;
                $question->area_id = $request->area_id;
                $question->active = $request->active? true: false;
                $question->save();
                $request->session()->flash('status', 'La pregunta ha sido actualizada');
                return redirect('/questions/update/' . $question->id);
            }
            $areas = \App\Area::lists('name', 'id');
            $processes = \App\Process::lists('name', 'id');
            return view('questions.update', [
                'question' => $question,
                'areas' => $areas,
                'processes' => $processes
            ]);
        }else{
            abort(404);
        }
    }
}

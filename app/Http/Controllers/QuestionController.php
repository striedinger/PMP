<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\QuestionRepository;
use App\Question;
use Excel;

class QuestionController extends Controller
{
    protected $questions;

    public function __construct(QuestionRepository $questions){
    	$this->middleware('auth');
        $this->middleware('role:admin');
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
            if(isset($request->image)){
                $image = $request->file('image')->getClientOriginalName();
                $path = base_path() . '/public/uploads/';
                $request->file('image')->move($path , $image);
            }else{
                $image = null;
            }
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
                'active' => $request->active? true: false,
                'image' => $image,
                'subject' => $request->subject? $request->subject : null
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
                if(isset($request->image)){
                    $image = $request->file('image')->getClientOriginalName();
                    $path = base_path() . '/public/uploads/';
                    $request->file('image')->move($path , $image);
                    $question->image = $image;
                }
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
                $question->subject = $request->subject? $request->subject : null;
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

    public function import(Request $request){
        if($request->isMethod('post')){
            if($request->hasFile('file')){
                Excel::load($request->file('file'), function($reader){
                    $results = $reader->get();
                    return $results->toArray();
                });
            }else{
                abort(404);
            }
        }else{
            return view('questions.import');
        }
    }

    public function delete(Request $request, $id){
        if($question = $this->questions->forId($id)){
            if($request->user()->isAdmin()){
                $question->delete();
                $request->session()->flash('status', 'La pregunta ha sido eliminada');
                return redirect('/questions/');
            }else{
                abort(403, 'No autorizado');
            }
        }else{
            abort(404);
        }
    }
}

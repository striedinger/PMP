<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\ExamRepository;
use App\Exam;

class ExamController extends Controller
{
    protected $exams;

    public function __construct(ExamRepository $exams){
    	$this->middleware('auth');
    	$this->exams = $exams;
    }

    public function index(Request $request){
    	$exams = $this->exams->all();
    	return view('exams.index', [
    		'exams' => $exams
    	]);
    }

    public function create(Request $request){
        if($request->isMethod('post')){
            $this->validate($request, [
                'name' => 'required|max:255',
                'duration' => 'required|numeric',
                'questions' => 'required|numeric',
            ]);
            Exam::create([
                'name' => $request->name,
                'description' => $request->description,
                'duration' => $request->duration,
                'questions' => $request->questions,
                'byArea' => $request->byArea? true: false
            ]);
            $request->session()->flash('status', 'El examen ha sido creado');
            return redirect('/exams');
        }
        return view('exams.create');
    }

    public function update(Request $request, $id){
        if($exam = $this->exams->forId($id)){
            if($request->isMethod('post')){
                $this->validate($request, [
                    'name' => 'required|max:255',
                    'duration' => 'required|numeric',
                    'questions' => 'required|numeric',
                ]);
                $exam->name = $request->name;
                $exam->description = $request->description;
                $exam->duration = $request->duration;
                $exam->questions = $request->questions;
                $exam->byArea = $request->byArea? true: false;
                $exam->save();
                $request->session()->flash('status', 'El examen ha sido actualizado');
                return redirect('/exams/update/' . $exam->id);
            }
            return view('exams.update', [
                'exam' => $exam
            ]);
        }else{
            abort(404);
        }
    }
}

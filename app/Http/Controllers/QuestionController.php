<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\QuestionRepository;
use App\Question;
use Excel;
use PHPExcel; 
use PHPExcel_IOFactory;
use DB;

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
                $objPHPExcel = PHPExcel_IOFactory::load($request->file('file'));
                $objWorksheet = $objPHPExcel->getActiveSheet();
                $highestRow = $objWorksheet->getHighestRow();
                DB::transaction(function() use($highestRow, $objWorksheet){
                    for ($row = 2; $row <= $highestRow; ++$row) {
                        switch($objWorksheet->getCellByColumnAndRow(8, $row)){
                            case 'Adquisiciones':
                                $area = 9;
                                break;
                            case 'Alcance':
                                $area = 2;
                                break;
                            case 'Calidad':
                                $area = 5;
                                break;
                            case 'Comunicaciones':
                                $area = 7;
                                break;
                            case 'Costos':
                                $area = 4;
                                break;
                            case 'Integración':
                                $area = 1;
                                break;
                            case 'Interesados':
                                $area = 10;
                                break;
                            case 'Marco de referencia y Procesos de Dirección':
                                $area = 11;
                                break;
                            case 'Recursos humanos':
                                $area = 6;
                                break;
                            case 'Riesgos':
                                $area = 8;
                                break;
                            case 'Tiempo':
                                $area = 3;
                                break;
                            default:
                                $area = 1;
                        }
                        switch($objWorksheet->getCellByColumnAndRow(9, $row)){
                            case 'Inicio':
                                $process = 1;
                                break;
                            case 'Cierre':
                                $process = 5;
                                break;
                            case 'Ejecución':
                                $process = 3;
                                break;
                            case 'Planeación':
                                $process = 2;
                                break;
                            case 'Seguimiento y Control':
                                $process = 4;
                                break;
                            default:
                                $process = 1;
                        }
                        Question::create([
                            'question' => $objWorksheet->getCellByColumnAndRow(1, $row),
                            'optionA' => $objWorksheet->getCellByColumnAndRow(2, $row),
                            'optionB' => $objWorksheet->getCellByColumnAndRow(3, $row),
                            'optionC' => $objWorksheet->getCellByColumnAndRow(4, $row),
                            'optionD' => $objWorksheet->getCellByColumnAndRow(5, $row),
                            'answer' => $objWorksheet->getCellByColumnAndRow(6, $row),
                            'description' => $objWorksheet->getCellByColumnAndRow(7, $row),
                            'area_id' => $area,
                            'process_id' => $process,
                            'subject' => $objWorksheet->getCellByColumnAndRow(10, $row),
                        ]);
                    }
                });
                $request->session()->flash('status', 'Se han importado las preguntas del archivo.');
                return redirect('/questions');
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

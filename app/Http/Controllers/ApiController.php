<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Repositories\SessionRepository;
use App\Repositories\AnswerRepository;

use Dingo\Api\Routing\Helpers;

class ApiController extends Controller
{

	use Helpers;

	public function __construct(SessionRepository $sessions, AnswerRepository $answers){
		$this->session = $sessions;
		$this->answers = $answers;
	}

    public function startSession(Request $request, $id){
        if($session = $this->session->forId($id)){
            $session->active = true;
            $session->save();
            return response()->json(['success'=>true, 'session'=>$session]);
        }else{
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('No se encontro la sesion');
        }
    }

    public function endSession(Request $request, $id){
        if($session = $this->session->forId($id)){
            if(isset($request->answer) && isset($request->option) && in_array($request->option, array("A", "B", "C", "D"))){
                if($answer = $this->answers->forId($request->answer)){
                    $answer->answer = $request->option;
                    $answer->save();
                }else{
                    throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('No se encontro la respuesta a guardar');
                }
            }
            $session->active = false;
            $session->save();
        }else{
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('No se encontro la sesion');
        }
    }

    public function questions(Request $request, $id){
    	if($session = $this->session->forId($id)){
    		$answers = $this->answers->forSession($session->id);
    		foreach($answers as $answer){
    			unset($answer->question->answer);
    		}
            $marked = $this->answers->forSessionMarked($session->id);
            foreach($marked as $answer){
                unset($answer->question->answer);
            }
    		$response = array();
    		return response()->json(['session'=>$session, 'questions' => $answers, 'marked' => $marked]);
    	}else{
    		throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('No se encontro la sesion');
    	}
    }

    public function saveAnswer(Request $request, $id){
        if($session = $this->session->forId($id)){
            if(isset($request->answer) && isset($request->option) && in_array($request->option, array("A", "B", "C", "D"))){
                if($answer = $this->answers->forId($request->answer)){
                    if(!isset($answer->answer)){
                        $answer->answer = $request->option;
                        if($request->marked){
                            $answer->marked = true;
                        }
                        if($answer->save()){
                            return response()->json(['success' => true, 'answer' => $answer]);
                        }else{
                            return response()->json(['success' => false, 'message' => 'Error guardando']);
                        }
                    }else{
                        return response()->json(['success'=>false, 'message' => 'Pregunta ya habia sido respondida']);
                    }
                }else{
                    throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('No se encontro la pregunta');                    
                }
            }else{
                throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Parametros ausentes o con errores');   
            }
        }else{
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('No se encontro la sesion');
        }
    }
}

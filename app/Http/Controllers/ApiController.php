<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Repositories\SessionRepository;
use App\Repositories\AnswerRepository;
use Dingo\Api\Routing\Helpers;
use DateTime;
use DB;
date_default_timezone_set('America/Bogota');
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
            /*if(isset($request->answer) && isset($request->option) && in_array($request->option, array("A", "B", "C", "D"))){
                if($answer = $this->answers->forId($request->answer)){
                    $answer->answer = $request->option;
                    $answer->save();
                }else{
                    throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('No se encontro la respuesta a guardar');
                }
            }*/
            //determinar diferencia de tiempo
            $now = new DateTime();
            $now = strtotime($now->format('Y-m-d H:i:s'));
            $last_update = strtotime($session->updated_at);
            $difference =  $now - $last_update  ;
            if($session->exam->duration == 0){
                $session->time = $session->time + $difference;
            }else{
                $session->time = $session->time - $difference;
            }
            $session->active = false;
            $session->save();
              return response()->json(['success'=>true, 'session'=>$session]);
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
 
                    if(!isset($answer->answer) || $answer->marked == true){
                        if($session->active == 1){
                            $answer->answer = $request->option;
                            if($request->marked){
                                $answer->marked = true;
                            }else{
                                $answer->marked = false;
                            }
                            //determinar diferencia de tiempo
                            DB::beginTransaction();
                            if($session->time>0 || $session->exam->duration == 0){

                                $now = new DateTime();
                                $now = strtotime($now->format('Y-m-d H:i:s'));
                                $last_update = strtotime($session->updated_at);
                                $difference =  $now - $last_update  ;
                                if($session->exam->duration == 0){
                                    $session->time = $session->time + $difference;
                                }else{
                                    $session->time = $session->time - $difference;
                                }                               
                                 
                                $session->save();

                                if($session->save()){
                                    if($answer->save()){
                                         DB::commit();
                                        return response()->json(['Xsuccess' => true, 'answer' => $answer]);
                                    }else{
                                         DB::rollback();
                                        return response()->json(['success' => false, 'message' => 'Error guardando']);
                                    }
                                }else{
                                     return response()->json(['success' => false, 'message' => 'Error guardando']);
                                     DB::rollback();
                                }
                                
                            }else{
                                return response()->json(['success'=>false, 'message' => 'Este examen ya finalizó']);
                            }

                           
                            return response()->json(['success'=>false, 'message' => 'Pregunta ya habia sido respondida']);
                        }else{
                              throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('La session esta detenida.'); 
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
}
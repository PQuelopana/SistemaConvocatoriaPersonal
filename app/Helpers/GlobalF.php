<?php
namespace App\Helpers;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Helpers\JwtAuth;

class GlobalF{
    
    public function __construct(){
    }
    
    public function validateObject($object, $objectName, $message = ''){
        $this->validateObjectConstruct($object, $objectName, 'dataErrorNotFound', $message);
    }
    
    public function validateObjectAuth($object, $objectName){
        $this->validateObjectConstruct($object, $objectName, 'dataErrorAuth');
    }
    
    public function validateObjectConstruct($object, $objectName, $configGlobal, $message = ''){
        if(!is_object($object)){
            $data = config('global.'.$configGlobal);
            if($message == ''){
                $data['message'] = str_replace(':object', $objectName, $data['message']);
            }else{
                $data['message'] = $message;
            }
        }
        
        if(isset($data)) $this->responseHttpExceptionApi($data);
    }
    
    public function requestJsonDecodeArr($request){
        $json = $request->input('json', null);
        
        if(!is_null($json)){
            $paramArr = json_decode($json, true);            
            if(!is_array($paramArr)){
                //$paramArr = array_map('trim', $paramArr);
            //}else{
                $data = config('global.dataErrorRequest');
                $data['message'] = trans('messages.json');
                $this->responseHttpExceptionApi($data);
            }
        }else{
            $paramArr = null;
        }
        
        return $paramArr;
    }
    
    public function responseApi($data){
        return response()->json($data, $data['code']);
    }
    
    public function responseHttpExceptionApi($data){
        throw new HttpResponseException(response()->json($data, $data['code']));
    }
    
    public function getIdentity($request){
        $jwtAuth = new JwtAuth();
        $token = $request->header('Authorization', null);
        $user = $jwtAuth->checkToken($token, true);
        
        return $user;
    }
    
    public function getObjectAndActionOfRequest($request){
        $objectAction = Route::getCurrentRoute()->getActionName();
        
        $slash = strrpos($objectAction, '\\');
        if($slash > 0){
            $objectAction = strtolower(str_replace('Controller', '', substr($objectAction, $slash + 1, strlen($objectAction))));
        }        
        
        return str_replace('@', '', $objectAction);
    }
    
    public function getArrayChangesByObject($object, $arr){
        
        switch ($object){
            case 'user':
                $arr = [
                    'name'      => $arr['name'],
                    'surname'   => $arr['surname'],
                    'email'     => $arr['email']
                ];                
            break;
            case 'convocatoria':
                $arr = [
                    'nombre'          => $arr['nombre'],
                    'fechaInicio'   => $arr['fechaInicio'],
                    'fechaFin'         => $arr['fechaFin']
                ];
            break;
            case 'order':
                $arr = [
                    'total'         => $arr['total']
                ];
            break;
        }
        
        return $arr;
    }
    
    public function generateCodeRandom(){
        return mt_rand(1, 9999);
    }
    
    public function getUserAuth($email, $password){
        $userController = new UserController();
        return $userController->getUserAuth($email, $password);
    }
}
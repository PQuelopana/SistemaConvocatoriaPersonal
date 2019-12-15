<?php

namespace App\Http\Middleware;

use Closure;

class ApiRequestValidateMiddleware extends \App\Helpers\GlobalF{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        
        $paramArr = $this->requestJsonDecodeArr($request);
        
        if(!empty($paramArr)){
            $objectAction = $this->getObjectAndActionOfRequest($request);
            
            $rules = config('global.'.$objectAction.'Validator');
            
            if($objectAction == 'userupdate'){
                $user = $this->getIdentity($request);
                $rules['email'] = $rules['email'].$user->sub;
            }
            
            $validate = \Validator::make($paramArr, $rules);
            
            if($validate->fails()){
                $data = config('global.dataErrorValidate');
                $data['errors'] = $validate->errors();
            }
            
            if(array_key_exists('details', $paramArr)){
                $index = 0;
                $rules = config('global.'.$objectAction.'DetailValidator');
                
                $paramDetailArr = $paramArr['details'];
                foreach ($paramDetailArr as $detail){
                    $validate = \Validator::make($detail, $rules);
            
                    if($validate->fails()){
                        if(!isset($data)){
                            $data = config('global.dataErrorValidate');
                        }
                        $errorsArr = ['Item' => $index + 1] + json_decode($validate->errors(), true);
                        
                        $data['errorsDetail'][$index] = $errorsArr;
                    }
                    
                    $index++;
                }
            }
        }else{
            $data = config('global.dataErrorRequest');
        }
        
        if(!isset($data)){
            return $next($request);
        }else{
            return response()->json($data, $data['code']);
        }        
    }
}

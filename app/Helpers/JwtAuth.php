<?php
namespace App\Helpers;

use Firebase\JWT\JWT;
use Iluminate\Suport\Facades\DB;

class JwtAuth extends GlobalF{
    public $key;
    public $globalF;
    
    public function __construct(){
        $this->key = '54544dv4ddf6gfg65e466r34345rg+-s';
    }
    
    public function signup($email, $password, $getToken = false){        
        //Buscar si existe el usuario con sus credenciales
        $user = $this->getUserAuth($email, $password);               
        
        //Generar el token con los datos del usuario identificado
        $token = [
            'sub'       => $user->id,
            'email'     => $user->email,
            'name'      => $user->name,
            'surname'   => $user->surname,
            'iat'       => time(),
            'exp'       => time() + (7 * 24 * 60 * 60) //Una semana de duracion
        ];

        $jwt = JWT::encode($token, $this->key, 'HS256');

        if(!$getToken){
            $data = $jwt;
        }else{
            $data = $token;
        }
        
        return $data;         
    }
    
    public function checkToken($jwt, $getIdentity = false){
        $auth = false;
        
        try{
            $jwt = str_replace('"', '', $jwt);
            $decoded = JWT::decode($jwt, $this->key, ['HS256']);
        } catch (\UnexpectedValueException $e) {            
            
        } catch (\DomainException $e){            
           
        }
        
        if(!empty($decoded) && is_object($decoded) && isset($decoded->sub)) $auth = true;
        
        if($getIdentity){
            $data = $decoded;
        }else{
            $data = $auth;
        }
        
        return $data;            
    }
}
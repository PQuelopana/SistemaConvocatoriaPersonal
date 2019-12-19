<?php
//use Illuminate\Support\Facades\Lang as LangGlobal;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$codeSuccess = 200;
$codeError = 400;
$codeNotFound = 404;

$convocatoriaValidator = [
    'nombre'                                => 'required',
    'fechaInicio'                           => 'required|date',
    'fechaFin'                              => 'required|date'
];

$postulanteValidator = [
    'nombres'                               => 'required',
    'apellidoPaterno'                       => 'required|alpha',
    'apellidoMaterno'                       => 'required|alpha',
    'idTipoDocumentoIdentidad'              => 'required|numeric',
    'numeroDocumentoIdentidad'              => 'required',
    'correo'                                => 'required|email|unique:Postulante',
    'contrasenna'                           => 'required|is_alpha_num',
    'estadoCivil'                           => 'required|alpha',
    'idDistrito'                            => 'required|numeric',
    'tipoZona'                              => 'required|alpha',
    'nombreZona'                            => 'required',
    'tipoVia'                               => 'required|alpha',
    'direccion'                             => 'required',
    'telefono'                              => 'required',
    'celular'                               => 'required'
];
        
$saleDetailValidator = [
    'item'               => 'required|numeric',
    'idProduct'              => 'required|numeric',
    'idTypeAffectation'                 => 'required|numeric',
    'indICBPER'           => 'required|numeric',
    'quantity'           => 'required|numeric',
    'unitPrice'           => 'required|numeric',
    'totalPrice'           => 'required|numeric'
];
  
return [
    'codeSuccess'           => $codeSuccess,
    'codeError'             => $codeError,
    'codeNotFound'          => $codeNotFound,
    'dataSuccessNoMessage'  => [
        'code'                  => $codeSuccess
    ],
    'dataSuccessMessage'    => [
        'code'                  => $codeSuccess,
        'message'               => ''
    ],
    'dataErrorValidate'     => [
        'code'                  => $codeError,
        'errors'                => ''
    ],
    'dataErrorRequest'      => [
        'code'                  => $codeError,
        'message'               => ''//trans('validation.requestFailed')
    ],
    'dataErrorAuth'         => [
        'code'                  => $codeError,
        'message'               => ''//trans['auth.failed']
    ],
    'dataErrorNotFound'     => [
        'code'                  => $codeNotFound,
        'message'               => ''
    ],
    'userstoreValidator'    => [
        'name'                  => 'required|alpha',
        'surname'               => 'required|alpha',
        'email'                 => 'required|email|unique:users',
        'password'              => 'required|is_alpha_num'
    ],
    'userupdateValidator'   => [
        'name'                  => 'required|alpha',
        'surname'               => 'required|alpha',
        'email'                 => 'required|email|unique:users,email,',
    ],
    'userloginValidator'    => [
        'email'                 => 'required|email',
        'password'              => 'required'
    ],
    'userpasswordrestoreValidator'  => [
        'password'                      => 'required|is_alpha_num',
        'codeRestoration'              => 'required|numeric'
    ],
    'convocatoriastoreValidator'           => $convocatoriaValidator,
    'convocatoriaupdateValidator'           => $convocatoriaValidator,
    'postulantestoreValidator'           => $postulanteValidator,
    //'saleupdateValidator'          => $saleValidator,
    'salestoreDetailValidator'     => $saleDetailValidator,
    'saleupdateDetailValidator'    => $saleDetailValidator
    
];
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Postulante As ObjectModel;

class PostulanteController extends Controller{
    
    public $object_s;
    public $object_p;
    public $objectName;
    public $objectNameArr;
    
    public function __construct() {
        $this->middleware('api.auth', [
            'only' => [
                'store', 
                'update',
                'destroy'
            ]
        ]);
        
        $this->middleware('api.request.validate', [
            'only' => [
                'store', 
                'update'                
            ]
        ]);
        
        $this->object_s = 'postulante';
        $this->object_p = 'postulantes';
        $this->objectName = trans('objects.'.$this->object_s);
        $this->objectNameArr = ['object' => $this->objectName];
    }
    
    public function store(Request $request){
        return $this->storeController($request, new ObjectModel(), $this->object_s, $this->objectNameArr);
    }
    
}

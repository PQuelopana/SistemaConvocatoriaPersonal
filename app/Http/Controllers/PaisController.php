<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pais As ObjectModel;

class PaisController extends Controller{
    public $object_s;
    public $object_p;
    public $objectName;
    public $objectNameArr;
    
    public function __construct() {
        $this->middleware('api.auth', [
            'only' => [
                //'store', 
                //'update',
                //'destroy'
            ]
        ]);
        
        $this->middleware('api.request.validate', [
            'only' => [
                'store', 
                'update'                
            ]
        ]);
        
        $this->object_s = 'pais';
        $this->object_p = 'paises';
        $this->objectName = trans('objects.'.$this->object_s);
        $this->objectNameArr = ['object' => $this->objectName];
    }
    
    public function index(){
        return $this->indexController(new ObjectModel(), $this->object_p, '', null, ['nombre', 'Asc']);
    }
    
    public function indexById($id){
        return $this->indexController(new ObjectModel(), $this->object_p, '', ['id' => $id], ['nombre', 'Asc']);
    }
}

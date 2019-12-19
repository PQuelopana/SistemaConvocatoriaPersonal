<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoDocumentoIdentidad As ObjectModel;

class TipoDocumentoIdentidadController extends Controller{
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
        
        $this->object_s = 'tipodocumentoidentidad';
        $this->object_p = 'tiposdocumentoidentidad';
        $this->objectName = trans('objects.'.$this->object_s);
        $this->objectNameArr = ['object' => $this->objectName];
    }
    
    public function index(){
        return $this->indexController(new ObjectModel(), $this->object_p, '', ['indActivo' => 1], ['idOficial', 'Asc']);
    }
    
    public function indexById($id){
        return $this->indexController(new ObjectModel(), $this->object_p, '', ['id' => $id], ['nombre', 'Asc']);
    }
}

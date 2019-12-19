<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provincia As ObjectModel;

class ProvinciaController extends Controller{
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
        
        $this->object_s = 'provincia';
        $this->object_p = 'provincias';
        $this->objectName = trans('objects.'.$this->object_s);
        $this->objectNameArr = ['object' => $this->objectName];
    }
    
    public function index(){
        return $this->indexController(new ObjectModel(), $this->object_p, '', null, ['nombre', 'Asc']);
    }
    
    public function indexByIdDepartamento($idDepartamento){
        return $this->indexController(new ObjectModel(), $this->object_p, '', ['idDepartamento' => $idDepartamento], ['nombre', 'Asc']);
    }
}

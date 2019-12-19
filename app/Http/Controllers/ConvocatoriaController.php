<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Convocatoria As ObjectModel;

class ConvocatoriaController extends Controller{
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
        
        $this->object_s = 'convocatoria';
        $this->object_p = 'convocatorias';
        $this->objectName = trans('objects.'.$this->object_s);
        $this->objectNameArr = ['object' => $this->objectName];
    }
    
    public function index(){
        return $this->indexController(new ObjectModel(), $this->object_p);
    }
    
    public function store(Request $request){
        return $this->storeController($request, new ObjectModel(), $this->object_s, $this->objectNameArr);
    }
    
    public function show($id){
        return $this->showController($id, new ObjectModel(), $this->object_s, $this->objectName);
    }

    public function update(Request $request, $id){
        return $this->updateController($id, $request, new ObjectModel(), $this->objectName, $this->object_s, $this->objectNameArr);
    }    
    
    public function destroy(Request $request, $id){
        return $this->destroyController($id, $request, new ObjectModel(), $this->objectName, $this->object_s, $this->objectNameArr);
    }
}

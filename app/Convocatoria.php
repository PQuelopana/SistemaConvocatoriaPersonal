<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Convocatoria extends Model{
    protected $table = 'convocatoria';
    
    public $timestamps = false;
    
    public function newObject($paramArr) {
        $fechaRegistro = date('Y-m-d', time());
        $horaRegistro = date('H:i:s', time());
        
        $anno = date('Y', strtotime($paramArr['fechaInicio']));
        
        $this->nombre = $paramArr['nombre'];
        $this->fechaInicio = $paramArr['fechaInicio'];
        $this->fechaFin = $paramArr['fechaFin'];
        $this->estado = 'V';
        $this->idAdministradorRegistro = 1;
        $this->fechaRegistro = $fechaRegistro;
        $this->horaRegistro = $horaRegistro;
        $this->ipRegistro = '';
        $this->idAdministradorModificacion = 0;
        $this->fechaModificacion = $fechaRegistro;
        $this->horaModificacion = $horaRegistro;
        $this->ipModificacion = '';
        $this->idAdministradorEliminacion = 0;
        $this->fechaEliminacion = $fechaRegistro;
        $this->horaEliminacion = $horaRegistro;
        $this->ipEliminacion = '';
        
        $this->idOficial = $this->generaIdOficial($anno);
    }
    
    public function generaIdOficial($anno){
        
        //$ultimaConvocatoria = $this->all()->whereYear('fechaInicio', '=', $anno)->last();
        $ultimaConvocatoria = Model::whereYear('fechaInicio', '=', $anno)->orderBy('idOficial', 'desc')->take(1)->get();
        /*$ultimaConvocatoria = 
            DB::table("convocatoria As A")
            ->where("Year(A.fechaInicio)", "=", $anno)
            ->select("A.idOficial")
            ->orderBy("A.idOficial", "desc")
            ->get()
        ;*/
        
        //echo $ultimaConvocatoria;
        //die();
        
        if($ultimaConvocatoria){
            $idOficial = $ultimaConvocatoria[0]->idOficial + 1;
        }else{
            $idOficial = 1;
        }
        
        return $idOficial;
    }
}

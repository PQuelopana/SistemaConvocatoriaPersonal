<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postulante extends Model{
    protected $table = 'Postulante';
    
    public $timestamps = false;
    
    public function newObject($paramArr) {
        $this->nombres = $paramArr['nombres'];
        $this->apellidoPaterno = $paramArr['apellidoPaterno'];
        $this->apellidoMaterno = $paramArr['apellidoMaterno'];
        $this->idTipoDocumentoIdentidad = $paramArr['idTipoDocumentoIdentidad'];
        $this->numeroDocumentoIdentidad = $paramArr['numeroDocumentoIdentidad'];
        $this->correo = $paramArr['correo'];
        $this->contraseña = $paramArr['contraseña'];
        $this->estadoCivil = $paramArr['estadoCivil'];
        $this->idDistrito = $paramArr['idDistrito'];
        $this->tipoZona = $paramArr['tipoZona'];
        $this->nombreZona = $paramArr['nombreZona'];
        $this->tipoVia = $paramArr['tipoVia'];
        $this->direccion = $paramArr['direccion'];
        $this->telefono = $paramArr['telefono'];
        $this->celular = $paramArr['celular'];
        $this->firmaElectronica = $paramArr['firmaElectronica'];
        $this->idColegioProfesional = null;
        $this->numeroRegistro = '';
        $this->indDiscapacidad = 0;
        $this->indFFAA = 0;
        $this->indInhabilitadoEstado = 0;
        $this->indPronabec = 0;
        $this->indPenales = 0;
        $this->indJudiciales = 0;
        $this->indPoliciales = 0;
        $this->indEtica = 0;
    }
    
    protected $hidden = [
        'contraseña', 'codigoRestauracion'
    ];
}

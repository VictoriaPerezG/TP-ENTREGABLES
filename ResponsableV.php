<?php

/* También se desea guardar la información de la persona responsable de realizar el viaje, para ello 
cree una clase ResponsableV que registre el número de empleado, número de licencia, nombre y apellido. */

class ResponsableV{

    //atributos de la clase 
    private $numEmpleado;
    private $numLicencia;
    private $nombre;
    private $apellido;

    // metodo constructor de la clase
    public function __construct($nroEmpl,$nroLic,$nombre,$apellido)
    {
        $this->numEmpleado=$nroEmpl;
        $this->numLicencia=$nroLic;
        $this->nombre=$nombre;
        $this->apellido=$apellido;
    }

    //metodos de acceso de la clase 
    public function getNroEmpleado(){
        return $this->numEmpleado;
    }
    public function setNroEmpleado($numero){
        $this->numEmpleado=$numero;
    }

    public function getNroLicencia(){
        return $this->numLicencia;
    }
    public function setNroLicencia($numero){
        $this->numLicencia=$numero;
    }

    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nombre){
        $this->nombre=$nombre;
    }

    public function getApellido(){
        return $this->apellido;
    }
    public function setApellido($apellido){
        $this->apellido=$apellido;
    }

    //metodo toString de la clase
    public function __toString()
    {
        return  "N° Empleado: ".$this->getNroEmpleado()."\n".
                "N° Licencia: ".$this->getNroLicencia()."\n".
                "Nombre: ".$this->getNombre()."\n".
                "Apellido: ".$this->getApellido()."\n";
                
    }

}
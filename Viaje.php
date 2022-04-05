<?php

/*La empresa de Transporte de Pasajeros “Viaje Feliz” quiere registrar la información referente a sus viajes. 
De cada viaje se precisa almacenar el código del mismo, destino, cantidad máxima de pasajeros y los pasajeros del viaje.

Realice la implementación de la clase Viaje e implemente los métodos necesarios para modificar los atributos de dicha clase 
(incluso los datos de los pasajeros). Utilice un array que almacene la información correspondiente a los pasajeros. 
Cada pasajero es un array asociativo con las claves “nombre”, “apellido” y “numero de documento”.*/


class Viaje{

    private $idViaje;
    private $destino;
    private $maximoPasajeros;
    private $pasajeros=[];

  

    public function __construct($codigoViaje,$destinoViaje,$cantMaxPasajeros,$pasajerosViaje){

        $this->idViaje=$codigoViaje;
        $this->destino=$destinoViaje;
        $this->maximoPasajeros=$cantMaxPasajeros;
        $this->pasajeros=$pasajerosViaje;

    }

    //codigo del viaje
    public function getCodigo(){
        return $this-> idViaje;
    }

    public function setCodigo($numero){

        $this-> idViaje =$numero;
    }

    //destino del viaje
    public function getDestino(){
        return $this-> destino;
    }

    public function setDestino($lugar){

        $this-> destino =$lugar;
    }

    //cantidad de pasajeros
    public function getMaximaPasajeros(){
        return $this-> maximoPasajeros;
    }

    public function setMaximaPasajeros($numero){

        $this-> maximoPasajeros =$numero;
    }

    //pasajeros del viaje
    public function getPasajeros(){
        return $this-> pasajeros;
    }

    public function setPasajeros($informacion){

        $this-> pasajeros =$informacion;
    }

    //array pasajeros 
    public function arrayPasajeros($arrayPasajero){
        
        return $this->setPasajeros($arrayPasajero);

        
    }


    public function __toString()
    {
    
        $cadena = "El codigo del viaje es: ". $this->getCodigo() ."\n" .
                  "El destino es: " . $this->getDestino()."\n".
                  "La cantidad maxima de pasajeros es: ". $this->getMaximaPasajeros()."\n".
                  "Los pasajeros son: ".print_r($this->getPasajeros(),true)."\n";

        return $cadena;            

    }



}
































?>
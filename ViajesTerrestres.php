<?php

/*La empresa de transporte desea gestionar la información correspondiente a los Viajes que pueden ser: Terrestres o
Aéreos, guardar su importe e indicar si el viaje es de ida y vuelta. De los viajes aéreos se conoce el número del
vuelo, la categoría del asiento (primera clase o no), nombre de la aerolínea, y la cantidad de escalas del vuelo en 
caso de tenerlas. De los viajes terrestres se conoce la comodidad del asiento, si es semicama o cama.

La empresa ahora necesita implementar la venta de un pasaje, para ello debe realizar la función 
venderPasaje(pasajero) que registra la venta de un viaje al pasajero que es recibido por parámetro. 
La venta se realiza solo si hayPasajesDisponible. 

Si el viaje es terrestre y el asiento es cama, se incrementa el importe un 25%. 

Si el viaje es aéreo y el asiento es primera clase sin escalas, se incrementa un 40%, si el viaje 
además de ser un asiento de primera clase, el vuelo tiene escalas se incrementa el importe del viaje un 60%. 

Tanto para viajes terrestres o aéreos, si el viaje es ida y vuelta, se incrementa el importe del viaje un 50%.
El método retorna el importe del pasaje si se pudo realizar la venta.

Implemente la función hayPasajesDisponible() que retorna verdadero si la cantidad de pasajeros del viaje es menor 
a la cantidad máxima de pasajeros y falso caso contrario.*/


class ViajesTerrestres extends Viaje{

    //atributos de clase viajes terrestres
    private $comodidadAsiento;

    //metodo constructor de la clase viajes terrestres
    public function __construct($codigoViaje,$destinoViaje,$cantMaxPasajeros,$colObjPasajeros,$responsableV,
    $importe, $idaYvuelta,$comodidad)
    {
        //se invoca al metodo contructor de la clase padre viaje
        parent::__construct($codigoViaje,$destinoViaje,$cantMaxPasajeros,$colObjPasajeros,$responsableV,
        $importe, $idaYvuelta);
            //atributo de la clase hijo viajes terrestres
            $this->comodidadAsiento=$comodidad;

    }

    //metodos de acceso de la clase viaje terrestre
    public function getComodidadAsiento(){
        return $this->comodidadAsiento;
    }
    public function setComodidadAsiento($comodidad){
        $this->comodidadAsiento = $comodidad;
    }

    /*Si el viaje es terrestre y el asiento es cama, se incrementa el importe un 25%.
    Tanto para viajes terrestres o aéreos, si el viaje es ida y vuelta, se incrementa el importe del viaje un 50%.
    El método retorna el importe del pasaje si se pudo realizar la venta. */
    public function venderPasaje($pasajero)
    {
        $comodidadAsiento = $this->getComodidadAsiento();
        $importe = $this->getImporte();
        $idaYvuelta = $this->getIdaYVuelta();

        $porcentaje25 = (( 25 * $importe) / 100 ); 

        if (parent::venderPasaje($pasajero))
        {
            if (($comodidadAsiento == "semicama") && ($idaYvuelta == "si")) 
            {
                $porcentaje = (( 50 * $importe) / 100);
                $newImporte = $importe + $porcentaje;
                $this->setImporte($newImporte);
            }
            elseif (($comodidadAsiento == "cama") && ($idaYvuelta == "si")){
                $importeAnterior = $importe + $porcentaje25;
                $porcentaje = (( 50 * $importeAnterior) / 100 );  
                $newImporte =  $importeAnterior + $porcentaje;
                $this->setImporte($newImporte);
            }
            elseif (($comodidadAsiento == "cama"))
            {
                $newImporte =  $importe + $porcentaje25;
                $this->setImporte($newImporte);
            }
           
            else{
                $newImporte = $importe;
            }
            
        }
        else
        {
            $newImporte = false;
        }

        return $newImporte;
        
    }



    //metodo to string de la clase viaje terrestre 
    public function __toString()
    {
        $cadena = parent::__toString();
        $cadena .= "Asiento: ". $this->getComodidadAsiento();
        return $cadena;
    }










}
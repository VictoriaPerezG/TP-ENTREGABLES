<?php 

/*La empresa de transporte desea gestionar la información correspondiente a los Viajes que pueden ser: Terrestres o
Aéreos, guardar su importe e indicar si el viaje es de ida y vuelta. 

De los viajes aéreos se conoce el número del vuelo, la categoría del asiento (primera clase o no), nombre de la 
aerolínea, y la cantidad de escalas del vuelo en caso de tenerlas. 

De los viajes terrestres se conoce la comodidad del asiento, si es semicama o cama.

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


class ViajesAereos extends Viaje{

    //atributos de la clase viajes aereos 
    private $nroVuelo;
    private $categoriaAsiento;
    private $aerolinea;
    private $escalasVuelo;

    //metodo contructor de la clase viajes aereos 
    public function __construct($codigoViaje,$destinoViaje,$cantMaxPasajeros,$colObjPasajeros,$responsableV,
    $importe, $idaYvuelta,$numVuelo,$catAsiento,$nombAerolinea,$escalas)
    {
         //se invoca al metodo contructor de la clase padre viaje
         parent::__construct($codigoViaje,$destinoViaje,$cantMaxPasajeros,$colObjPasajeros,$responsableV,
         $importe, $idaYvuelta);
             //atributo de la clase hijo viajes aereos 
             $this->nroVuelo=$numVuelo;
             $this->categoriaAsiento=$catAsiento;
             $this->aerolinea=$nombAerolinea;
             $this->escalasVuelo=$escalas;

    }

     //metodos de acceso de la clase viajes aereos
     public function getNroVuelo(){
        return $this->nroVuelo;
    }
    public function setNroVuelo($numero){
        $this->nroVuelo=$numero;
    }

    public function getCategoriaAsiento(){
        return $this->categoriaAsiento;
    }
    public function setCategoriaAsiento($tipo){
        $this->categoriaAsiento=$tipo;
    }

    public function getAerolinea(){
        return $this->aerolinea;
    }
    public function setAerolinea($nombre){
        $this->aerolinea=$nombre;
    }

    public function getEscalasVuelo(){
        return $this->escalasVuelo;
    }
    public function setEsaclasVuelo($escalas){
        $this->escalasVuelo=$escalas;
    }

    /*Si el viaje es aéreo y el asiento es primera clase sin escalas, se incrementa un 40%, si el viaje 
    además de ser un asiento de primera clase, el vuelo tiene escalas se incrementa el importe del viaje un 60%. 

    Tanto para viajes terrestres o aéreos, si el viaje es ida y vuelta, se incrementa el importe del viaje un 50%.
     El método retorna el importe del pasaje si se pudo realizar la venta.
     */
    public function venderPasaje($pasajero)
    {
        $importe = $this->getImporte();
        $asiento = $this->getCategoriaAsiento();
        $escalas = $this->getEscalasVuelo();
        $idaYvuelta = $this->getIdaYVuelta();

        $porcentajeIdaYVuelta = ((50 * $importe) / 100); // si el viaje es ida y vuelta es este el porcentaje
        $porcentaje40 = ((40 * $importe) / 100);
        $porcentaje60 = ((60 * $importe) / 100);

        if(parent::venderPasaje($pasajero)){

            if (($asiento == "primera clase") && ($escalas >= 1) && ($idaYvuelta == "si")){
                $importeAnterior = $importe + $porcentaje60;
                $porcentaje =  ((50 * $importeAnterior) / 100);
                $newImporte = $importeAnterior + $porcentaje ; 
                $this->setImporte($newImporte);
            }
            elseif (($asiento == "primera clase") && ($escalas == 0) && ($idaYvuelta == "si")){
                $importeAnterior = $importe + $porcentaje40;
                $porcentaje =  ((50 * $importeAnterior) / 100);
                $newImporte = $importeAnterior + $porcentaje ; 
                $this->setImporte($newImporte);
            }
            elseif ( ($asiento == "primera clase") && ($escalas == 0)) {
                $newImporte = $importe + $porcentaje40;
                $this->setImporte($newImporte);
            }
            elseif( ($asiento == "primera clase") && ($escalas >= 1)){
                $newImporte = $importe + $porcentaje60;
                $this->setImporte($newImporte);
            }
            elseif(($idaYvuelta == "si") && ($asiento = "ninguna") ){
                $newImporte = $importe + $porcentajeIdaYVuelta;
                $this->setImporte($newImporte);
            }
            else{//en caso de ser sin escalas, sin primera clase y sin ida y vuelta 
                $newImporte = $importe;
            }

        }
        else{
            $newImporte = false;
        }

        return $newImporte;
        
    }

    //metodo to string de la clase viajes aereos 
    public function __toString()
    { 
        $cadena = parent:: __toString();
        $cadena .= "Aerolinea: ". $this->getAerolinea()."\n". 
                    "Numero Vuelo: ". $this->getNroVuelo()."\n". 
                    "Categoria Asiento: ". $this->getCategoriaAsiento()."\n". 
                    "Escalas del Vuelo: ". $this->getEscalasVuelo()."\n";

        return $cadena;            
    }




}
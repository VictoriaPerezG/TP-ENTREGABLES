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

class Viaje{

    private $idViaje;
    private $destino;
    private $maximoPasajeros;
    private $pasajeros;
    private $objResponsableV;
    //nuevos atributos para la clase viaje 
    private $importe;
    private $idaYvuelta;

    //metodo constructor de la clase
    public function __construct($codigoViaje,$destinoViaje,$cantMaxPasajeros,$colObjPasajeros,$responsableV,
    $importe, $idaYvuelta){

        $this->idViaje=$codigoViaje;
        $this->destino=$destinoViaje;
        $this->maximoPasajeros=$cantMaxPasajeros;
        $this->pasajeros=$colObjPasajeros;
        $this->objResponsableV = $responsableV;
        ///////////////////////////////////////
        $this->importe = $importe;
        $this->idaYvuelta = $idaYvuelta;

    }

    //metodos de acceso
    public function getCodigo(){
        return $this-> idViaje;
    }
    public function setCodigo($numero){

        $this-> idViaje =$numero;
    }


    public function getDestino(){
        return $this-> destino;
    }
    public function setDestino($lugar){

        $this-> destino =$lugar;
    }

    public function getMaximaPasajeros(){
        return $this-> maximoPasajeros;
    }
    public function setMaximaPasajeros($numero){

        $this-> maximoPasajeros =$numero;
    }
    
    public function getArrayPasajeros(){
        return $this-> pasajeros;
    }
    public function setArrayPasajeros($arrayPasajeros){

        $this-> pasajeros =$arrayPasajeros;
    }

    public function getObjResponsableV(){
        return $this-> objResponsableV;
    }
    public function setObjResponsableV($objResp){

        $this-> objResponsableV =$objResp;
    }

    public function getImporte(){
        return $this-> importe;
    }
    public function setImporte($numero){

        $this-> importe =$numero;
    }

    public function getIdaYVuelta(){
        return $this-> idaYvuelta;
    }
    public function setIdaYVuelta($tipo){

        $this-> idaYvuelta =$tipo;
    }

    /*En esta funcion se va a modificar los datos de un pasajero del arreglo pasajero, si se desea modificar 
    unicamente un arrglo 
     dentro de un arreglo indexado se utiliza un recorrido parcial */
    public function ModificarDatosPasajero($Pviaje,$dniAnterior,$nombrePnew, $apellidoPnew,$newTele){

        //se inicializan las variables para la repetitiva
        $arrayPasajeros = $this->getArrayPasajeros();
        $i=0;
        $encontrado=false;

        while ($i < count($arrayPasajeros) && !$encontrado) {
            
            $pasajero = $arrayPasajeros[$i]; //se obtiene la instancia de un obj pasajero
            $encontrado = ($pasajero->getDocumento() == $dniAnterior);
            $i++;

        }

        if($encontrado){
            //en esta parte no se asigna un nuevo numero de documento a un pasajero
            $newObjPasajero=new Pasajeros($nombrePnew,$apellidoPnew,$dniAnterior , $newTele);//se crea un nuevo obj pasajero
            $arrayPasajeros[$i-1] = $newObjPasajero ; /*se asigna el pasajero modificado en el puesto anterior dentro 
                                                    del arrayPasajeros */
            $Pviaje = $this->setArrayPasajeros($arrayPasajeros);
        }

        return $Pviaje;

    }
    

    //se desea modificar la informacion del responsable del viaje
    public function ModificarDatosResponsable($nroEmpleado, $nroLicencia, $nombre, $apellido){

        $objResponsableV= $this-> getObjResponsableV();//se obtiene el objeto responsable

        $objResponsableV= new ResponsableV ($nroEmpleado, $nroLicencia, $nombre, $apellido); //se crea un nuevo obj responsable del viaje

        return $this->setObjResponsableV($objResponsableV);

    }




    
    //Se muestran los datos de los pasajeros en forma de string, usando un recorrido exhaustivo/
    public function toStringPasajeros()
    {
        $colPasajeros = $this->getArrayPasajeros();
        $pasajero = "";        
        
        for ($i=0; $i <count($colPasajeros) ; $i++) { 
            $objPasajero= $colPasajeros[$i];  
            $nroPasaj = $i ;
            $pasajero = $pasajero . " " .$nroPasaj . "\n".
                        $objPasajero. "\n";
        }

        return  $pasajero;

    }
    
    /*La empresa ahora necesita implementar la venta de un pasaje, para ello debe realizar la función 
     venderPasaje(pasajero) que registra la venta de un viaje al pasajero que es recibido por parámetro. 
     La venta se realiza solo si hayPasajesDisponible.*/
     public function venderPasaje($pasajero)
     {
         $arrayPasajeros = $this->getArrayPasajeros();
         $value = false;

        if($this->hayPasajesDisponibles()){
           
            $i = count($arrayPasajeros);
            $arrayPasajeros[$i] = $pasajero;
            $this->setArrayPasajeros($arrayPasajeros);
            $value = true;
        }

        return $value;


     }

     /*Implemente la función hayPasajesDisponible() que retorna verdadero si la cantidad de pasajeros del viaje es 
     menor a la cantidad máxima de pasajeros y falso caso contrario */
     public function hayPasajesDisponibles(){

        $arrayPasajeros = $this->getArrayPasajeros();//obtengo la coleccion para ontar la cantidad de pasajeros cargados en el viaje
        $maximoPasajeros = $this->getMaximaPasajeros();//obtengo la cantidad maxima de los pasajeros para un viaje 
        $value = false;

        if(count($arrayPasajeros) < $maximoPasajeros){
            $value=true;
        }

        return $value;

     }


    // metodo toString de la clase viaje
    public function __toString()
    {
       // $cadenaPasajeros=$this->toStringPasajeros();
        $objResp = $this->getObjResponsableV();

        $cadena = "El codigo del viaje es: ". $this->getCodigo() ."\n" .
                  "El destino es: " . $this->getDestino()."\n".
                  "La cantidad maxima de pasajeros es: ". $this->getMaximaPasajeros()."\n".
                  "Importe del Viaje: ".$this->getImporte()."\n".
                  "Ida Y Vuelta?: ".$this->getIdaYVuelta()."\n".
                  "El Responsable del viaje es: " .$objResp->getNombre(). " " . $objResp->getApellido()."\n".
                  "N° Empleado: ".$objResp->getNroEmpleado()."-"."N° Licencia: ".$objResp->getNroLicencia()."\n".
                  "Los pasajeros son:\n". $this->toStringPasajeros();

        return $cadena;            

    }



}


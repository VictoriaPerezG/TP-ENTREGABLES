<?php 

/*Entregable TP 2
Modificar la clase Viaje para que ahora los pasajeros sean un objeto que tenga los atributos nombre, apellido, 
numero de documento y teléfono. El viaje ahora contiene una referencia a una colección de objetos de la clase 
Pasajero. 

También se desea guardar la información de la persona responsable de realizar el viaje, para ello 
cree una clase ResponsableV que registre el número de empleado, número de licencia, nombre y apellido. 
La clase Viaje debe hacer referencia al responsable de realizar el viaje. 

Volver a implementar las operaciones que permiten modificar el nombre, apellido y 
teléfono de un pasajero. 
Luego implementar la operación que agrega los pasajeros al viaje, solicitando por consola la información de los 
mismos. 
Se debe verificar que el pasajero no este cargado mas de una vez en el viaje. 
De la misma forma cargue la información del responsable del viaje.
Nota: Recuerden que deben enviar el link a la resolución en su repositorio en GitHub.*/


class Viaje{

    private $idViaje;
    private $destino;
    private $maximoPasajeros;
    private $pasajeros;
    private $objResponsableV;

    //metodo constructor de la clase
    public function __construct($codigoViaje,$destinoViaje,$cantMaxPasajeros,$colObjPasajeros,$responsableV){

        $this->idViaje=$codigoViaje;
        $this->destino=$destinoViaje;
        $this->maximoPasajeros=$cantMaxPasajeros;
        $this->pasajeros=$colObjPasajeros;
        $this->objResponsableV = $responsableV;

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
    



    // metodo toString de la clase viaje
    public function __toString()
    {
       // $cadenaPasajeros=$this->toStringPasajeros();
        $objResp = $this->getObjResponsableV();

        $cadena = "El codigo del viaje es: ". $this->getCodigo() ."\n" .
                  "El destino es: " . $this->getDestino()."\n".
                  "La cantidad maxima de pasajeros es: ". $this->getMaximaPasajeros()."\n".
                  "El Responsable del viaje es: " .$objResp->getNombre(). " " . $objResp->getApellido()."\n".
                  "N° Empleado: ".$objResp->getNroEmpleado()."-"."N° Licencia: ".$objResp->getNroLicencia()."\n".
                 "Los pasajeros son:\n". $this->toStringPasajeros();

        return $cadena;            

    }



}




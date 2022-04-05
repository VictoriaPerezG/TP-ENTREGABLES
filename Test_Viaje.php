<?php

/*Implementar un script testViaje.php que cree una instancia de la clase Viaje y presente un menú que permita cargar la
 información del viaje, modificar y ver sus datos.*/

include "Viaje.php";


//menu que permite ingresar la informacion de un nuevo viaje
echo "Ingresar el codigo del viaje: ";
$codigo=trim(fgets(STDIN));
echo "Ingresar el destino del viaje: ";
$destino=trim(fgets(STDIN));
echo "Ingresar la capacidad maxima de pasajeros para el viaje: ";
$maxPasajeros=trim(fgets(STDIN));


do{

    echo "Ingresar datos de los pasajeros \n";
    echo "Nombre: ";
    $nombre=trim(fgets(STDIN));
    echo "Apellido: ";
    $apellido=trim(fgets(STDIN));
    echo "DNI: ";
    $dni=trim(fgets(STDIN));


    echo "Desea introducir otro pasajero?(si/no) ";
    $rta = trim(fgets(STDIN)); 
    $pasajeros[]=["Nombre" => $nombre, "apellido" => $apellido,"DNI" => $dni];

}	
while($rta == "si" );


echo "\n";
//inicializo la clase viaje y le agrego los datos ingresados en el menu 
$viaje1 = new Viaje($codigo,$destino,$maxPasajeros,$pasajeros);
echo $viaje1;
echo "\n";



echo "Deseas modificar la informacion del viaje?(si/no) ";
$rta=trim(fgets(STDIN));

if($rta=="si"){
    echo "Que dato deseas modificar? ";
    $dato=trim(fgets(STDIN));
       
    if($dato=="codigo")
    {
        echo "Ingresar nuevo codigo: ";
        $codigoNuevo=trim(fgets(STDIN));
        $viaje1->setCodigo($codigoNuevo);
        echo "El nuevo codigo es: ". $viaje1->getCodigo();
            
    }
    elseif($dato=="destino")
    {
        echo "Ingresar nuevo destino: ";
        $destinoNuevo=trim(fgets(STDIN));
        $viaje1->setDestino($destinoNuevo);
        echo "El nuevo destino es: ". $viaje1->getDestino();
            
    }
    elseif($dato=="maximo pasajeros")
    {
        echo "Ingresar nuevo maximo de pasajeros: ";
        $maxPasajerosNuevo=trim(fgets(STDIN));
        $viaje1->setMaximaPasajeros($maxPasajerosNuevo);
        echo "La nueva maxima de pasajeros es: ". $viaje1->getMaximaPasajeros();
            
    }
    elseif($dato=="pasajeros")
    {
        do{

            echo "Ingresar datos nuevos de los pasajeros \n";
            echo "Nombre: ";
            $nombre=trim(fgets(STDIN));
            echo "Apellido: ";
            $apellido=trim(fgets(STDIN));
            echo "DNI: ";
            $dni=trim(fgets(STDIN));
        
        
            echo "Desea introducir otro pasajero?(si/no) ";
            $rta = trim(fgets(STDIN)); 
            $pasajerosNuevos[]=["Nombre" => $nombre, "apellido" => $apellido,"DNI" => $dni];
        
        }	
        while($rta == "si" );
          
        $viaje1->arrayPasajeros($pasajerosNuevos);
        echo "Los nuevos pasajeros son: ". print_r($viaje1->getPasajeros(),true) ;


    }

    echo "\n";
    echo "Datos actualizados del viaje: \n";
    echo $viaje1;



}
else
{
    echo "\n";
    echo "Datos finales del viaje: \n";
    echo $viaje1;
   
}




<?php

/*Entregable TP 2
Modificar la clase Viaje para que ahora los pasajeros sean un objeto que tenga los atributos nombre, apellido, 
numero de documento y teléfono. El viaje ahora contiene una referencia a una colección de objetos de la clase 
Pasajero. 

También se desea guardar la información de la persona responsable de realizar el viaje, para ello 
cree una clase ResponsableV que registre el número de empleado, número de licencia, nombre y apellido. 
La clase Viaje debe hacer referencia al responsable de realizar el viaje. 

Volver a implementar las operaciones que permiten modificar el nombre, apellido y 
teléfono de un pasajero. Luego implementar la operación que agrega los pasajeros al viaje, 
solicitando por consola la información de los mismos. Se debe verificar que el pasajero 
no este cargado mas de una vez en el viaje. De la misma forma cargue la información del responsable del viaje.
Nota: Recuerden que deben enviar el link a la resolución en su repositorio en GitHub.*/


//incluyo todos las clases 
include "Viaje2.php";
include "Pasajeros.php";
include "ResponsableV.php";

//creo los objetos pasajeros
$pasajeros1 = new Pasajeros("Agustin","Gomez",43216200,2995673947);
$pasajeros2 = new Pasajeros("Federico","perez",24366736,2996080887);
$pasajeros3 = new Pasajeros("Gabriela","Garate",75849308,2956739469);
$pasajeros4 = new Pasajeros("Graciela","rojas",36748905,2959465484);

//creo un objeto responsable del viaje
$respon = new ResponsableV(123,156,"pepe","aguello");

///////////DATOS PRE CARGADOS////////////////

//creo el arreglo indexado con los objetos persona
$pasajeros=[$pasajeros1,$pasajeros2,$pasajeros3,$pasajeros4];
//echo print_r($pasajeros);

//inicializo la clase viaje 
$viaje1 = new Viaje(100,"Bariloche",25,$pasajeros,$respon);
echo $viaje1."\n\n";


/**************uso de los set para cambiar los valores*****************/
//presente un menú que permita cargar la información del viaje, modificar y ver sus datos
do{
    echo "\nMenu del Viaje \n";
    echo "Si desea modificar algun dato ingrese la opcion indicada:
    (1)ver datos viaje 
    (2)modifica datos viaje 
    (3)modificar pasajeros
    (4)modificar datos Responsable viaje 
    (x)salir\n ";
    echo "Ingrese una opcion: \n";
    $opcion= trim(fgets(STDIN));

    if ($opcion==1) {
        echo "\n LOS DATOS DEL VIAJE SON: \n";
        echo $viaje1."\n";
    }
    elseif ($opcion == 2) {

        echo $viaje1."\n";
        //modifico el codigo del viaje
        echo "Ingrese un nuevo codigo de viaje: ";
        $newId = trim(fgets(STDIN));
        $viaje1->setCodigo($newId);
        //modifico el destino del viaje
        echo "Ingrese el nuevo destino del viaje: ";
        $newDestino = trim(fgets(STDIN));
        $viaje1->setDestino($newDestino);
        //modifico la cantidad maxima de pasajeros para el viaje
        echo "Ingrese la nueva cantidad maxima de pasajeros para el viaje: ";
        $newCantMax = trim(fgets(STDIN));
        $viaje1->setMaximaPasajeros($newCantMax);
        echo $viaje1."\n";
        
    }
    elseif ($opcion==3) {

        //muestro los datos pre cargados de los pasajeros
        $cadena= $viaje1->toStringPasajeros();
        echo $cadena."\n";

        //modificar datos de un pasajero
        echo "Ingrese el numero del pasajero que desea modificar \n";
        $num = trim(fgets(STDIN));
        echo "Ingrese el documento del pasajero que desea modificar \n";
        $doc = trim(fgets(STDIN));
        echo "Ingrese el nombre nuevo del pasajero\n";
        $nomNew = trim(fgets(STDIN));
        echo "Ingrese el apellido nuevo del pasajero\n";
        $apellidoNew = trim(fgets(STDIN));
        echo "Ingrese el nuevo telefono del pasajero que desea modificar\n ";
        $teleNew = trim(fgets(STDIN));
        $viaje1->ModificarDatosPasajero($num,$doc,$nomNew,$apellidoNew,$teleNew);
        echo $viaje1;
    }
    elseif($opcion == 4){

        echo "Los anteriores datos del responbale son: \n";
        echo $viaje1->getObjResponsableV()."\n\n";
        echo "Ingrese nuevo numero de empleado: \n";
        $newNroEmpleado= trim(fgets(STDIN));
        echo "Ingrese nuevo numero de Licencia: \n";
        $newNroLicEmpleado= trim(fgets(STDIN));
        echo "Ingrese nuevo nombre del empleado: \n";
        $newNomEmpleado= trim(fgets(STDIN));
        echo "Ingrese nuevo apellido del empleado: \n\n";
        $newApellEmpleado= trim(fgets(STDIN));
        $newEmpleado= $viaje1->ModificarDatosResponsable($newNroEmpleado,$newNroLicEmpleado,$newNomEmpleado,$newApellEmpleado);
        echo "Los nuevos datos del responbale son: \n";
        echo $viaje1->getObjResponsableV();

    }
    else {
        echo "Saliendo del menu....";
    }
    


}while ( ($opcion>=1) && ($opcion<=4) );
 
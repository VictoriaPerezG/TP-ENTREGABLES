<?php

//test viaje del tp entregable 3

//incluyo todos las clases 
include "Viaje3.php";
include "Pasajeros.php";
include "ResponsableV.php";
include "ViajesTerrestres.php";
include "ViajesAereos.php";

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

//inicializo la clase viaje 
$viaje1 = new Viaje(100,"Bariloche",10,$pasajeros,$respon,400,"si");
//echo "\n".$viaje1."\n\n";

//inicializo las clases hijas de viaje terrestre y aereo con los mismos datos y agregos los faltantes
$viajeTerrestre = new ViajesTerrestres(100,"Bariloche",10,$pasajeros,$respon,400,"si","cama");
echo "\n VIAJE TERRESTRE\n".$viajeTerrestre."\n\n";
//100,"Bariloche",10,$pasajeros,$respon,400,"si",567,"1°clase","ARG",2
$viajeAereo = new ViajesAereos(115,"La Plata",10,$pasajeros,$respon,400,"si",354,"ninguna","ARG",2);
echo "\n VIAJE AEREO\n".$viajeAereo."\n\n";


/**************uso de los set para cambiar los valores*****************/
//presente un menú que permita cargar la información del viaje, modificar y ver sus datos
do{
    echo "\nMenu del Viaje \n";
    echo "Si desea modificar algun dato ingrese la opcion indicada:
    (1)ver datos viaje 
    (2)modifica datos viaje 
    (3)modificar pasajeros
    (4)modificar datos Responsable viaje 
    (5)vender pasaje
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
        //modifico el importe del viaje
        echo "Ingrese el nuevo importe del viaje: ";
        $newImporte= trim(fgets(STDIN));
        $viaje1->setImporte($newImporte);
        //modifico el tipo de vuelta o ida del viaje
        echo "Ingrese nueva ida y vuelta (si/no): ";
        $newIdayVuelta= trim(fgets(STDIN));
        $viaje1->setIdaYVuelta($newIdayVuelta);

        echo "\nDatos modificados del viaje: \n". $viaje1."\n";
        
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

    }elseif( $opcion == 5){
    
        //creo el nuevo pasajero 
        echo "Ingrese el nombre del pasajero\n";
        $nombre = trim(fgets(STDIN));
        echo "Ingrese el apellido del pasajero\n";
        $apellido = trim(fgets(STDIN));
        echo "Ingrese el documento del pasajero \n";
        $doc = trim(fgets(STDIN));
        echo "Ingrese el nuevo telefono del pasajero\n ";
        $telefono = trim(fgets(STDIN));
        $pasajero = new Pasajeros($nombre,$apellido,$doc,$telefono);

        //selecciona que tipo de viaje para saber que datos pedir 
        echo "\n Ingrese que tipo de viaje va a realizar(terrestre/aereo): ";
        $opcion = trim(fgets(STDIN));

        if ($opcion == "terrestre")
        {
            echo "Asiento(cama/semicama): ";
            $asiento = trim(fgets(STDIN));
            $viajeTerrestre->setComodidadAsiento($asiento);
            $importe = $viajeTerrestre->venderPasaje($pasajero);//esta funcion puede devolver tanto un numero como un valor booleano
            echo $importe ? "Se realizo la venta, el importe es de $importe \n ": "No se puede realizar la venta \n";
            
        }
        elseif($opcion == "aereo")
        {
            echo "Categoria Asiento(primera clase/ninguna): ";
            $catAsiento = trim(fgets(STDIN));
            $viajeAereo->setCategoriaAsiento($catAsiento);
            $importe = $viajeAereo->venderPasaje($pasajero);//esta funcion puede devolver tanto un numero como un valor booleano
            echo $importe ? "Se realizo la venta, el importe es de $importe \n ": "No se puede realizar la venta \n";
            
        }
       

    }
    else {
        echo "Saliendo del menu....";
    }
    


}while ( ($opcion>=1) && ($opcion<=4) );
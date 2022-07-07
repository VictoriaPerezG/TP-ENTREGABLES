<?php

include 'BaseDatosTPO.php';
include 'empresa.php';
include 'pasajero.php';
include 'viaje.php';
include 'responsable.php';


/**********************************MENU GENERAL*****************************************/
function menuGeneral(){

	do{	
		echo "\n MENU GENERAL \n";
		echo "(1)VIAJES\n"; 
		echo "(2)PASAJEROS \n";
		echo "(3)RESPONSABLE VIAJE \n";
		echo "(4)EMPRESA \n";
		echo "(x)salir\n ";
		echo "Ingrese una opcion: \n";
		$opcion= trim(fgets(STDIN));

		if ($opcion == 1) {
			echo menuViaje();
		}
		else if ($opcion == 2) {
			echo  menuPasajero();
		}	
		else if ($opcion == 3) {
			echo menuResponsable();
		}
		else if ($opcion == 4) {
			echo menuEmpresa();
		}		
		else {
			echo "Saliendo del programa";
		}	

	}while ($opcion <= 4);	

}


/************************* MENU EMPRESA ************************************/
function menuEmpresa(){
	
	do {
		echo "\nMENU EMPRESA: \n";  
		echo "(1)Ingresar empresa\n";
		echo "(2)Modificar datos empresa\n";
		echo "(3)Eliminar empresa\n";
		echo "(4)Listar empresa\n";
		echo "(x)salir\n ";
		echo "INGRESE UNA OPCION: ";
		$opcion= trim(fgets(STDIN));
	

			if ($opcion == 1) {
				$rta = false;

				echo "Ingrese el id de la empresa: ";
				$id= trim(fgets(STDIN));	
				echo "Ingrese el nombre de la empresa: ";
				$nombre= trim(fgets(STDIN));	
				echo "Ingrese Direccion: ";
				$dire = trim(fgets(STDIN));

				$newEmpresa = new empresa();
				$newEmpresa->cargar($id,$nombre,$dire);
				$rta = $newEmpresa->InsertarEmpresa();	
				
				if ($rta == true) {
					echo "\n LA EMPRESA FUE INGRESADA A LA BD \n";
					
					$colEmpresas = $newEmpresa->listar("");
					foreach ($colEmpresas as $unaEmpresa){
						echo "-------------------------------------------------------";
						echo  $unaEmpresa;
						echo "-------------------------------------------------------";
					} 
				}
				else{
					echo $newEmpresa->getMensajeOperacion();
				}
				
	
			}			
			else if ($opcion == 2) {//modificar datos de una empresa
				$objEmpresa = new empresa();
				$rta = false;
				echo "\nIngrese el id de la empresa que desea modificar: ";
				$id = trim(fgets(STDIN));

						if ($objEmpresa->BuscarEmpresa($id) == true) {
							echo "Ingrese nuevo nombre: ";
							$empNombre = trim(fgets(STDIN));
							echo "Ingrese nueva direccion: ";
							$dire = trim(fgets(STDIN));
							$objEmpresa->setENombre($empNombre);
							$objEmpresa->setEDireccion($dire);
							$rta = $objEmpresa->ActualizarEmpresa();	
						
						}
						else{
							echo "\n -- No se encontro empresa con ese id \n";
							
						}
					
								   
				if($rta == true){
					echo "\n SE MODIFICO LA EMPRESA\n";
					$colEmpresas = $objEmpresa->listar("");
					foreach ($colEmpresas as $empresa){
						
						echo "-------------------------------------------------------";
						echo $empresa;
						echo "-------------------------------------------------------";
					}	
				}
				else{
					echo $objEmpresa->getMensajeOperacion();
				}
				
				
			}
			else if ($opcion == 3) {
				$objEmpresa = new empresa();
				$rta = false;

				echo "Ingrese el id de la empresa que desea eliminar : ";
				$id = trim(fgets(STDIN));
					
					if ($objEmpresa->BuscarEmpresa($id) == true) {
						$rta = $objEmpresa->EliminarEmpresa();
						
					}
					else{
						echo "\n -- No se encontro empresa con ese id \n";
					}
				
				
				if ($rta == true) {
					echo " \n SE ELIMINO LA EMPRESA DE LA BD \n";
					$colEmpresas = $objEmpresa->listar("");	
					foreach ($colEmpresas as $empresa){
						
						echo "-------------------------------------------------------";
						echo $empresa;
						echo "-------------------------------------------------------";
					}
			   }
			   else{
				echo $objEmpresa->getMensajeOperacion();
			   }
			}
			else if($opcion == 4){
				
				$objEmpresa = new empresa();
				$colEmpresas = $objEmpresa->listar("");	

					foreach ($colEmpresas as $empresa){
						
						echo "-------------------------------------------------------";
						echo $empresa;
						echo "-------------------------------------------------------";
					}
			
			}
	
	} while ($opcion <= 4);
	
}


/***************************MENU RESPONSABLE*****************************/
function menuResponsable(){
	
	do {
		echo "\nMENU RESPONSABLE: \n";  
		echo "(1)Ingresar responsable\n";
		echo "(2)Modificar datos responsable\n";
		echo "(3)Eliminar responsable\n";
		echo "(4)Listar responsable\s\n";
		echo "(x)salir\n ";
		echo "INGRESE UNA OPCION: ";
		$opcion= trim(fgets(STDIN));
	
			if ($opcion == 1) {
				$rta = false;

				echo "Ingrese numero responsable: ";
				$num= trim(fgets(STDIN));	
				echo "Ingrese numero licencia responsable ";
				$lic= trim(fgets(STDIN));	
				echo "Ingrese el nombre del responsable: ";
				$nombre= trim(fgets(STDIN));	
				echo "Ingrese el apellido del responsable: ";
				$ape = trim(fgets(STDIN));
				
				$newResp = new responsable();
				$newResp->cargar($num,$lic,$nombre,$ape);
				$rta = $newResp->InsertarResponsable();	
				
				if ($rta == true) {
					echo "\n EL RESPONSABLE FUE INGRESADA A LA BD \n";
					
					$colResponsable = $newResp->listar("");
					foreach ($colResponsable as $unResp){
						echo "-------------------------------------------------------";
						echo  $unResp;
						echo "-------------------------------------------------------";
					} 
				}
				else{
					echo $newResp->getMensajeOperacion();
				}
				
	
			}
			else if($opcion == 2){
				$objRespo = new responsable();
				$rta = false;

				echo "\nIngrese el numero del responsable que desea modificar: ";
				$num = trim(fgets(STDIN));

						if ($objRespo->BuscarResponsable($num) == true) {
							echo "Ingrese nuevo numero de licencia: ";
							$lic = trim(fgets(STDIN));
							echo "Ingrese nuevo nombre de responsable: ";
							$nombre = trim(fgets(STDIN));
							echo "Ingrese nueva apellido de responsable: ";
							$ape = trim(fgets(STDIN));

							$objRespo->setNroLicenciaR($lic);
							$objRespo->setNombreR($nombre);
							$objRespo->setApellidoR($ape);
							$rta = $objRespo->ActualizarResponsable();	
							
						}
						else{
							echo "\n -- No se encontro  un responsable con ese id \n";
						}
					
								   
				if($rta == true){
					echo "\nSE MODIFICO EL RESPONSABLE\n";
					$colResponsable = $objRespo->listar("");
					foreach ($colResponsable as $unResp){
						
						echo "-------------------------------------------------------";
						echo $unResp;
						echo "-------------------------------------------------------";
					}	
				}
				else{
					echo $objRespo->getMensajeOperacion();
				   }
				
			}
			else if($opcion == 3){
				
				$objRespo = new responsable();
				$rta = false;

				echo "Ingrese numero del responsable que desea eliminar : ";
				$num = trim(fgets(STDIN));
					
					if ($objRespo->BuscarResponsable($num) == true) {
						$rta = $objRespo->EliminarResponsable();
					}
					else{
						echo "\n -- No se encontro responsable con ese numero \n";
					}
				
				
				if ($rta == true) {
					echo " \n SE ELIMINO EL RESPONSABLE DE LA BD \n";

					$colResponsable = $objRespo->listar("");	
					foreach ($colResponsable as $resp){
						
						echo "-------------------------------------------------------";
						echo $resp;
						echo "-------------------------------------------------------";
					}
			   }
			   else{
				echo $objRespo->getMensajeOperacion();
			   }
			}
			else if($opcion == 4){
				
				$objRespo = new responsable();
				$colResponsable = $objRespo->listar("");	

					foreach ($colResponsable as $responsable){
						
						echo "-------------------------------------------------------";
						echo $responsable;
						echo "-------------------------------------------------------";
					}
			
			}

	}while ($opcion <= 4); 
}


/***************************MENU PASAJERO*****************************/
function menuPasajero(){
	
	do {
		echo "\nMENU PASAJERO: \n";  
		echo "(1)Ingresar pasajero\n";
		echo "(2)Modificar datos pasajero\n";
		echo "(3)Eliminar pasajero\n";
		echo "(4)Listar pasajero\n";
		echo "(x)salir\n ";
		echo "INGRESE UNA OPCION: ";
		$opcion= trim(fgets(STDIN));
	
			if ($opcion == 1) {
				$rta = false;

				echo "Ingrese dni pasajero: ";
				$dni = trim(fgets(STDIN));	
				echo "Ingrese nombre del pasajero: ";
				$nom = trim(fgets(STDIN));	
				echo "Ingrese el apellido del pasajero: ";
				$ape = trim(fgets(STDIN));	
				echo "Ingrese el telefono del pasajero: ";
				$tele = trim(fgets(STDIN));
				echo "Ingrese id del viaje: ";
				$idviaje = trim(fgets(STDIN));
								
				$newPasaj = new pasajero();
				$objviaje = new viaje();
				$objviaje->BuscarViaje($idviaje);

				$newPasaj->cargar($dni,$nom,$ape,$tele,$objviaje);
				$rta = $newPasaj->InsertarPasajero();	
				
				if ($rta == true) {
				
					echo "\n EL PASAJERO FUE INGRESADA A LA BD \n";					
					$colPasajeros = $newPasaj->listar("");

					foreach ($colPasajeros as $pasajero){
						echo "-------------------------------------------------------";
						echo  $pasajero;
						echo "-------------------------------------------------------";
					} 
				}
				else{
					echo $newPasaj->getMensajeOperacion();
				}
				
	
			}
			else if($opcion == 2){
				$objPasaj= new pasajero();
				$rta = false;

				echo "\nIngrese el dni del pasajero que desea modificar: ";
				$num = trim(fgets(STDIN));

						if ($objPasaj->BuscarPasajero($num) == true) {
							echo "Ingrese nuevo nombre: ";
							$nom = trim(fgets(STDIN));
							echo "Ingrese nuevo apellido: ";
							$ape = trim(fgets(STDIN));
							echo "Ingrese nuevo telefono: ";
							$tele= trim(fgets(STDIN));
							
							$objPasaj->setNombreP($nom);
							$objPasaj->setApellidoP($ape);
							$objPasaj->setTelefonoP($tele);
							
							$rta = $objPasaj->ActualizarPasajero();	
						
						}
						else{
							echo "\n -- No se encontro  un pasajero con ese dni \n";
						}
					
								   
				if($rta == true){
					echo "\n SE MODIFICO AL PASAJERO \n";
					$colPasajeros = $objPasaj->listar("");
					foreach ($colPasajeros  as $pasajero){
						
						echo "-------------------------------------------------------";
						echo $pasajero;
						echo "-------------------------------------------------------";
					}	
				}
				else{
					echo $objPasaj->getMensajeOperacion();
				   }
				
			}
			else if($opcion == 3){
				
				$objPasaj = new pasajero();
				$rta = false;

				echo "Ingrese dni del pasajero que desea eliminar : ";
				$dni = trim(fgets(STDIN));
					
					if ($objPasaj->BuscarPasajero($dni) == true) {
						$rta = $objPasaj->EliminarPasajero();
					}
					else{
						echo "\n -- No se encontro pasajero con ese dni \n";
					}
				
				
				if ($rta == true) {
					echo " \n SE ELIMINO EL PASAJERO DE LA BD \n";

					$colPasa = $objPasaj->listar("");	
					foreach ($colPasa as $pasajero){
						
						echo "-------------------------------------------------------";
						echo $pasajero;
						echo "-------------------------------------------------------";
					}
			   }
			   else{
				echo $objPasaj->getMensajeOperacion();
			   }
			}
			else if($opcion == 4){
				
				$objPasajero = new pasajero();
				$colPasajeros = $objPasajero->listar("");	

					foreach ($colPasajeros as $pasajero){
						
						echo "-------------------------------------------------------";
						echo $pasajero;
						echo "-------------------------------------------------------";
					}
			
			}

	}while ($opcion <= 4); 
}


/**********************************MENU VIAJE************************************************************/

function menuViaje(){
	
	do {
		echo "\nMENU VIAJE: \n";  
		echo "(1)Ingresar viaje\n";
		echo "(2)Modificar datos viaje\n";
		echo "(3)Eliminar viaje\n";
		echo "(4)Listar viajes\n ";
		echo "(x)salir\n ";
		echo "INGRESE UNA OPCION: ";
		$opcion= trim(fgets(STDIN));
	
			if ($opcion == 1) {
				$rta = false;

				echo "Ingrese id: ";
				$id = trim(fgets(STDIN));	
				echo "Ingrese destino: ";
				$dest = trim(fgets(STDIN));	
				echo "Ingrese max pasajeros: ";
				$maxpasa = trim(fgets(STDIN));	
				echo "Ingrese importe: ";
				$importe = trim(fgets(STDIN));
				echo "Ingrese tipo asiento: ";
				$asiento = trim(fgets(STDIN));
				echo "Ingrese ida y vuelta: ";
				$idayvuelta = trim(fgets(STDIN));
				

				//da las coleccion de empresas y busca el id para verificar que exista  y despues lo setea a la funcion cargar
				$objEmpresa = new empresa();
				$colEmpresas = $objEmpresa->listar("");	

					foreach ($colEmpresas as $empresas){
						
						echo "-------------------------------------------------------";
						echo $empresas;
						echo "-------------------------------------------------------";
					}
					 
				echo "\nIngrese id empresa: ";
				$idempresa = trim(fgets(STDIN));
				$objEmpresa->BuscarEmpresa($idempresa);

				//da las coleccion de responsables y busca el numero para verificar que exista  y despues lo setea a la funcion cargar
				$objRespo = new responsable();
				$colResponsable = $objRespo->listar("");	

					foreach ($colResponsable as $responsable){
						
						echo "-------------------------------------------------------";
						echo $responsable;
						echo "-------------------------------------------------------";
					}
					 
				
				echo "\nIngrese nro responsable: ";
				$nror = trim(fgets(STDIN));
				$objRespo->BuscarResponsable($nror);
			

				$objViaje = new viaje(); 
				$colViajes = $objViaje ->listar("");

				foreach ($colViajes as $viaje) {
					if($viaje->getVDestino() == $dest){
						echo "No se puede agregar dos viajes con el mismo destino ";
						$value = false;
					}
					else{
						$value = true;
					}
				}

				if ($value) {	
					$objViaje->cargar($id,$dest,$maxpasa,null,$objEmpresa,$objRespo,$idayvuelta,$importe,$asiento,);
					$rta = $objViaje->InsertarViaje();	
					
				}
				
				if ($rta == true) {
					echo "\nSE INSERTO EL VIAJE EN LA BD\n";
					$colViajes = $objViaje->listar("");
					foreach ($colViajes as $viaje){
										
						echo "-------------------------------------------------------";
						echo $viaje;
						echo "-------------------------------------------------------";
					}
				}
				
				
	
			}
			else if($opcion == 2){
				$objviaje= new viaje();
				$rta = false;

				echo "\nIngrese el id del viaje que desea modificar: ";
				$num = trim(fgets(STDIN));

						if ($objviaje->BuscarViaje($num) == true) {
							
							echo "Ingrese nuevo destino: ";
							$des = trim(fgets(STDIN));
							echo "Ingrese cant max pasajero: ";
							$max = trim(fgets(STDIN));
							echo "Ingrese nuevo importe : ";
							$importe = trim(fgets(STDIN));
							echo "Ingrese nuevo tipo asiento: ";
							$tipoAsiento = trim(fgets(STDIN));
							echo "Ingrese nuevo ida y vuelta : ";
							$idaVuelta= trim(fgets(STDIN));

							//da las coleccion de empresas y busca el id para verificar que exista  y despues lo setea a la funcion cargar
							$objEmpresa = new empresa();
							$colEmpresas = $objEmpresa->listar("");	

								foreach ($colEmpresas as $empresas){
									
									echo "-------------------------------------------------------";
									echo $empresas;
									echo "-------------------------------------------------------";
								}
								
							echo "\nIngrese id de la nueva empresa: ";
							$idempresa = trim(fgets(STDIN));
							$objEmpresa->BuscarEmpresa($idempresa);

							//da las coleccion de responsables y busca el numero para verificar que exista  y despues lo setea a la funcion cargar
							$objRespo = new responsable();
							$colResponsable = $objRespo->listar("");	

								foreach ($colResponsable as $responsable){
									
									echo "-------------------------------------------------------";
									echo $responsable;
									echo "-------------------------------------------------------";
								}
								
							
							echo "\nIngrese nuevo nro responsable: ";
							$nror = trim(fgets(STDIN));
							$objRespo->BuscarResponsable($nror);
			

							$objviaje->setObjResponsableV($objRespo);
							$objviaje->setObjEmpresaV($objEmpresa);

							$objviaje->setVDestino($des);
							$objviaje->setMaximaPasajeros($max);
							$objviaje->setImporteV($importe);
							$objviaje->setTipoAsientoV($tipoAsiento);
							$objviaje->setIdaYVueltaV($idaVuelta);
						
							$rta = $objviaje->ActualizarViaje();	
						
						}
						else{
							echo "\n -- No se encontro  un viaje con ese id \n";
						}
					
								   
				if($rta == true){
					echo "\n SE MODIFICO EL VIAJE \n";
					$colViajes = $objviaje->listar("");
					foreach ($colViajes as $viaje){
						
						echo "-------------------------------------------------------";
						echo $viaje;
						echo "-------------------------------------------------------";
					}	
				}
				else{
					echo $objviaje->getMensajeOperacion();
				   }
				
			}
			else if($opcion == 3){
				
				$objviaje = new viaje();
				$rta = false;

				echo "Ingrese id del viaje que desea eliminar : ";
				$id = trim(fgets(STDIN));
				 

				if ($objviaje ->BuscarViaje($id)){
				
					$objPasaj = new pasajero();
					$colPasajeros = $objPasaj->listar("idviaje=".$objviaje->getidviaje());

					if ( count($colPasajeros) > 0 ) {
						echo "\n -- No se puede eliminar este viaje por que tiene pasajeros \n";
						
					}	
					else{
						$rta = $objviaje->EliminarViaje();
					}								
								
					
				}
				else{
					echo "\n--No se encontro un viaje con ese id \n";
				}
				
				
				if ($rta == true) {
					echo " \n SE ELIMINO EL VIAJE DE LA BD \n";

					$colViaje = $objviaje->listar("");	
					foreach ($colViaje as $viaje){
						
						echo "-------------------------------------------------------";
						echo $viaje;
						echo "-------------------------------------------------------";
					}
			   }
			   else{
				echo $objviaje->getMensajeOperacion();
			   }
			}
			else if($opcion == 4){
				
				$objViaje = new viaje();
				$colViajes = $objViaje->listar("");	

					foreach ($colViajes as $viaje){
						
						echo "-------------------------------------------------------";
						echo $viaje;
						echo "-------------------------------------------------------";
					}
			
			}

	}while ($opcion <= 3); 
}




echo menuGeneral();
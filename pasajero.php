<?php

class pasajero{
    private $rdocumento; 
    private $pnombre; 
    private $papellido; 
	private $ptelefono;
	private $objViaje;
	private $mensajeoperacion;

    public function __construct()
    {
        $this->rdocumento = "";
        $this->pnombre = "";
        $this->papellido = "";
        $this->ptelefono = "";
    }

    //metodos de acceso 
    public function getNombreP(){
        return $this->pnombre;
    }
    public function setNombreP($nombre){
        $this->pnombre = $nombre;
    }

    public function getApellidoP(){
        return $this->papellido;
    }
    public function setApellidoP($apellido){
        $this->papellido = $apellido;
    }

    public function getDocumentoP(){
        return $this->rdocumento;
    }
    public function setDocumentoP($numero){
        $this->rdocumento = $numero;
    }

    public function getTelefonoP(){
        return $this->ptelefono;
    }
    public function setTelefonoP($numero){
        $this->ptelefono = $numero;
    }

    public function getObjViaje(){
        return $this->objViaje;
    }
    public function setObjViaje($ob){
        $this->objViaje = $ob;
    }

    public function getMensajeOperacion(){
		return $this->mensajeoperacion ;
	}
	public function setMensajeOperacion($mensajeoperacion){
		$this->mensajeoperacion=$mensajeoperacion;
	}


    //metodo toString 
    public function __toString()
    {
        return 
			"\n PASAJERO \n".
                "NOMBRE: ".$this->getNombreP()."\n".
                "APELLIDO: ".$this->getApellidoP()."\n".
                "DNI: ".$this->getDocumentoP()."\n".
                "TELEFONO: ".$this->getTelefonoP()."\n"
                 .$this->getObjViaje() ."\n";
                
    }

     //FUNCIONES DE LA CLASE 
    public function cargar($numeroDni,$nombre,$apellido,$tele,$objViaje){		
		
		$this->setDocumentoP($numeroDni);
		$this->setNombreP($nombre);
		$this->setApellidoP($apellido);
        $this->setTelefonoP($tele);
        $this->setObjViaje($objViaje);
    }

    /**
	 * Recupera los datos del pasajero por su numero de documneto 
	 * @param int $dni  
	 * @return boolean 
	 */		
    public function BuscarPasajero($dni){
		$base = new BaseDatos();
        $resp = false;

		$consultaBusqueda = "SELECT * from pasajero where rdocumento=".$dni;
       
        if($base->Iniciar()){
			if($base->Ejecutar($consultaBusqueda)){
				if($row2 = $base->Registro()){					
				    $this->setDocumentoP($dni);
					$this->setNombreP($row2['pnombre']);
					$this->setApellidoP($row2['papellido']);
					$this->setTelefonoP($row2['ptelefono']);

					$objViaje = new viaje();
					$objViaje->BuscarViaje($row2['idviaje']);
                    $this->setObjViaje($objViaje);

					$resp = true;
				}				
			
		 	}	else { 
		 			$this->setMensajeOperacion($base->getError());
		 		
			}
		 }	else {
		 		$this->setMensajeOperacion($base->getError());
		 	
		 }		
		 return $resp;
	}	

    /** Coloca la clase en una tabla de la base de datos
     * @param ()  
     * @return boolean 
     */
    public function InsertarPasajero(){
		$base = new BaseDatos();
		$resp = false;

		$consultaInsertar="INSERT INTO pasajero(rdocumento, pnombre, papellido, ptelefono, idviaje) 
				VALUES ('".$this->getDocumentoP()."','".$this->getNombreP()."','".$this->getApellidoP()."','".$this->getTelefonoP().
                "','".$this->getObjViaje()->getIdViaje()."')";
		
		if($base->Iniciar()){

			if($base->Ejecutar($consultaInsertar)){

			    $resp= true;

			}else {
					$this->setMensajeOperacion($base->getError());
					
			}

		} else {
				$this->setMensajeOperacion($base->getError());
			
		}
		return $resp;
	}


    /** Actualiza los datos de la tabla pasajero en la base de datos que coincida con su numero de documento
     * @param ()  
     * @return boolean
    */
    public function ActualizarPasajero(){
	    $resp = false; 
	    $base = new BaseDatos();
      
		$consultaModifica="UPDATE pasajero SET pnombre =' ".$this->getNombreP(). "',papellido='".$this->getApellidoP().
        "',ptelefono='".$this->getTelefonoP()."',idviaje='". $this->getObjViaje()->getIdViaje() ."' WHERE rdocumento=". $this->getDocumentoP();

		if($base->Iniciar()){
			if($base->Ejecutar($consultaModifica)){
			    $resp=  true;
			}else{
				$this->setMensajeOperacion($base->getError());
				
			}
		}else{
				$this->setMensajeOperacion($base->getError());
			
		}
		return $resp;
	}
	
    /**Elimina el registro del objeto en la tabla de la base de datos
     * @param ()
     * @return boolean
     */
    public function EliminarPasajero(){
		$base = new BaseDatos();
		$resp = false;

		if($base->Iniciar()){
				$consultaBorra="DELETE FROM pasajero WHERE rdocumento=".$this->getDocumentoP();
				if($base->Ejecutar($consultaBorra)){
				    $resp=  true;
				}else{
						$this->setMensajeOperacion($base->getError());
					
				}
		}else{
				$this->setMensajeOperacion($base->getError());
			
		}
		return $resp; 
	}

    /**Lista todas los pasajeros que cumplen con cierta condicio 
	 * @param void
     * @return array 
	 */
	public function listar($condicion = ""){
	    $arregloPasajeros = null;
		$base = new BaseDatos();
		$consultaPasajeros = "SELECT * from pasajero ";
		if ($condicion != "")
		{
		    $consultaPasajeros = $consultaPasajeros.' where '.$condicion; 
		}
		
		
		$consultaPasajeros.=" order by rdocumento ";

		if($base->Iniciar()){
			if($base->Ejecutar($consultaPasajeros)){				
				$arregloPasajeros = array();
				while($row2 = $base->Registro()){//DEVUELVE LAS TABLAS DE LA BASE DE DATOS CAMBIANDO EL CURSOR DE LUGAR
					
					$dni = $row2['rdocumento'];
                    $objPasajero = new pasajero();
                    $objPasajero->BuscarPasajero($dni);
					
					array_push($arregloPasajeros,$objPasajero);
	
				}
				
		 	}	else {
		 			$this->setMensajeOperacion($base->getError());
		 		
			}
		 }
		 else {
		 		$this->setMensajeOperacion($base->getError());
		 	
		 }	 
		 return $arregloPasajeros;
		}

}


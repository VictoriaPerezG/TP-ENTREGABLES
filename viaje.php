<?php

class viaje{
    private $idviaje;
	private $vdestino;
    private $vcantmaxpasajeros;
    private $vimporte;
    private $tipoAsiento;
    private $idayvuelta;
    private $mensajeoperacion;

    //variable instancia de otras clases
    private $objPasajero;
	private $objEmpresa;
    private $objResponsable; 

    public function __construct()
    {
        $this->idviaje = '';
        $this->vdestino = '';
        $this->vcantmaxpasajeros = '';
        $this->vimporte = '';
        $this->tipoAsiento = '';
        $this->idayvuelta = '';
        
    }

    //metodos de acceso
    public function getIdViaje(){
        return $this-> idviaje;
    }
    public function setIdViaje($numero){

        $this-> idviaje = $numero;
    }

    public function getVDestino(){
        return $this-> vdestino;
    }
    public function setVDestino($lugar){

        $this-> vdestino = $lugar;
    }

    public function getMaximaPasajeros(){
        return $this-> vcantmaxpasajeros;
    }
    public function setMaximaPasajeros($numero){

        $this-> vcantmaxpasajeros = $numero;
    }
    
    public function getObjPasajero(){
        return $this-> objPasajero;
    }
    public function setObjPasajero($objPasajeros){

        $this-> objPasajero = $objPasajeros;
    }

    public function getObjResponsableV(){
        return $this-> objResponsable;
    }
    public function  setObjResponsableV($objResp){

        $this-> objResponsable = $objResp;
    }

    public function getObjEmpresaV(){
        return $this-> objEmpresa;
    }
    public function setObjEmpresaV($objEmpresa){

        $this-> objEmpresa = $objEmpresa;
    }

    public function getImporteV(){
        return $this-> vimporte;
    }
    public function setImporteV($importe){

        $this-> vimporte = $importe;
    }

    public function getTipoAsientoV(){
        return $this-> tipoAsiento;
    }
    public function setTipoAsientoV($tipo){

        $this-> tipoAsiento = $tipo;
    }

    public function getIdaYVueltaV(){
        return $this-> idayvuelta;
    }
    public function setIdaYVueltaV($idayvuelta){

        $this-> idayvuelta = $idayvuelta;
    }

    public function getMensajeOperacion(){
		return $this->mensajeoperacion ;
	}
	public function setMensajeOperacion($mensajeoperacion){
		$this->mensajeoperacion=$mensajeoperacion;
	}


     // metodo toString de la clase viaje
     public function __toString()
     {  
        $cadena = "\n VIAJE \n".
                "ID VIAJE: ". $this->getIdViaje() ."\n" .
                "DESTINO: " . $this->getVDestino()."\n".
                "MAX PASAJEROS: ". $this->getMaximaPasajeros()."\n".
                "IMPORTE: ".$this->getImporteV()."\n".
                "TIPA ASIENTO:". $this->getTipoAsientoV()."\n".
                "IDA Y VUELTA:". $this->getIdaYVueltaV()."\n".

                $this-> getObjResponsableV(). "\n " . 

                 $this->getObjEmpresaV()."\n";
               
 
         return $cadena;            
 
     }

    //FUNCIONES DE LA CLASE 
    public function cargar($codigoViaje,$destinoViaje,$cantMaxPasajeros,$objPasajeros,$objEmpresa,$responsableV,$idayvuelta,$importe,$tipo){		
		$this->setIdViaje($codigoViaje);
		$this->setVDestino($destinoViaje);
		$this->setMaximaPasajeros($cantMaxPasajeros);
        $this->setObjPasajero($objPasajeros);
        $this-> setObjResponsableV($responsableV);
        $this->setObjEmpresaV($objEmpresa);
        $this->setIdaYVueltaV($idayvuelta);
        $this->setImporteV($importe);
        $this->setTipoAsientoV($tipo);
    }


    /** Coloca la clase en una tabla de la base de datos
     * @param ()  
     * @return boolean 
     */
    public function InsertarViaje(){
		$base = new BaseDatos();
		$resp = false; 

		$consultaInsertar="INSERT INTO viaje(idviaje, vdestino, vcantmaxpasajeros, idempresa, rnumeroempleado, vimporte, tipoAsiento, idayvuelta) 
				VALUES ('".$this->getIdViaje()."','".$this->getVDestino()."','".$this->getMaximaPasajeros()."','"
                .$this->getObjEmpresaV()->getIdEmpresa().
                "','".$this->getObjResponsableV()->getNroEmpleadoR()."','".$this->getImporteV()."','"
                .$this->getTipoAsientoV()."','".$this->getIdaYVueltaV()."')";
               
		
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

    /**
	 * Recupera los datos del viaje por su numero de identificacion 
	 * @param int $id
	 * @return boolean 
	 */		
    public function BuscarViaje($id){
		$base = new BaseDatos();
		$consultaBusqueda = "SELECT * from viaje where idviaje=".$id;
		$resp = false;

        if($base->Iniciar()){
			if($base->Ejecutar($consultaBusqueda)){
				if($row2 = $base->Registro()){				
				    $this->setIdViaje($id);
					$this->setVDestino($row2['vdestino']);
					$this->setMaximaPasajeros($row2['vcantmaxpasajeros']);
                   
                    $objempresa = new empresa();
                    $objresp = new responsable();

					$objempresa->BuscarEmpresa($row2['idempresa']);
                    $this->setObjEmpresaV($objempresa);

					$objresp->BuscarResponsable($row2['rnumeroempleado']);
                    $this->setObjResponsableV($objresp);

                    $this->setImporteV($row2['vimporte']);
                    $this->setTipoAsientoV($row2['tipoAsiento']);
                    $this->setIdaYVueltaV($row2['idayvuelta']);
					$resp= true;
				}				
			
		 	} else { 
		 			$this->setMensajeOperacion($base->getError());
		 		
			}
		 }	else {
		 		$this->setMensajeOperacion($base->getError());
		 	
		 }		
		 return $resp;
	}	

    
    /** Actualiza los datos de la tabla viaje en la base de datos que coincida con su numero de identificacion
     * @param ()  
     * @return boolean
    */
    public function ActualizarViaje(){
	    $resp = false; 
	    $base = new BaseDatos();

		$consultaModifica="UPDATE viaje SET vdestino='".$this->getVDestino(). "',vcantmaxpasajeros='".$this->getMaximaPasajeros().
        "',idempresa='".$this->getObjEmpresaV() ->getIdEmpresa() ."',rnumeroempleado='". $this->getObjResponsableV() ->getNroEmpleadoR().
        "',vimporte='".$this->getImporteV(). 
        "',tipoAsiento='".$this->getTipoAsientoV(). "', idayvuelta='".$this->getIdaYVueltaV() ."'WHERE idviaje=". $this->getIdViaje();

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
    public function EliminarViaje(){
		$base = new BaseDatos();
		$resp = false;

		if($base->Iniciar()){
				$consultaBorra="DELETE FROM viaje WHERE idviaje=".$this->getIdViaje();
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

    /**Lista todas los viajes que cumplen con cierta condicio 
	 * @param void 
     * @return array 
	 */
	public function listar($condicion = ""){
	    $arregloViajes = null;
		$base = new BaseDatos();
		$consultaViajes = "SELECT * from viaje ";
		if ($condicion != ""){
		    $consultaViajes = $consultaViajes.' where '.$condicion;
		}
		$consultaViajes.=" order by idviaje ";

		if($base->Iniciar()){
			if($base->Ejecutar($consultaViajes)){				
				$arregloViajes = array();
				while($row2 = $base->Registro()){

					$viaje = new viaje();
					$viaje->BuscarViaje($row2['idviaje']);
				
					array_push($arregloViajes,$viaje);
	
				 }				
			
            }	
            else {
		 		$this->setMensajeOperacion($base->getError());
		 		
			}
		 }
         else {
		 	$this->setMensajeOperacion($base->getError());
		 	
		 }	 
		 return $arregloViajes;
	}
 
}



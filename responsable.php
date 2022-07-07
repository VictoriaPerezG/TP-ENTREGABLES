<?php


class responsable{
    private $rnumeroempleado;
    private $rnumerolicencia;
	private $rnombre;
    private $rapellido;
	private $mensajeoperacion;

    public function __construct()
    {
        $this->rnumeroempleado = "";
        $this->rnumerolicencia = "";
        $this->rnombre = "";
        $this->rapellido = "";
    }

    //funciones de acceso 
    public function getNroEmpleadoR(){
        return $this->rnumeroempleado;
    }
    public function setNroEmpleadoR($numero){
        $this->rnumeroempleado = $numero;
    }

    public function getNroLicenciaR(){
        return $this->rnumerolicencia;
    }
    public function setNroLicenciaR($numero){
        $this->rnumerolicencia = $numero;
    }

    public function getNombreR(){
        return $this->rnombre;
    }
    public function setNombreR($nombre){
        $this->rnombre = $nombre;
    }

    public function getApellidoR(){
        return $this->rapellido;
    }
    public function setApellidoR($apellido){
        $this->rapellido = $apellido;
    }

    public function getMensajeOperacion(){
		return $this->mensajeoperacion ;
	}
    public function setMensajeOperacion($mensajeoperacion){
		$this->mensajeoperacion = $mensajeoperacion;
	}
	

    //metodo toString de la clase
    public function __toString()
    {
        return  "\n RESPONSABLE \n ". 
                "N° RESPONSABLE: ".$this->getNroEmpleadoR()."\n".
                "N° LICENCIA: ".$this->getNroLicenciaR()."\n".
                "NOMBRE: ".$this->getNombreR()."\n".
                "APELLIDO: ".$this->getApellidoR()."\n";
                
    }

    //FUNCIONES DE LA CLASE 
    public function cargar($nroEmpl,$nroLic,$nombre,$apellido){		
		$this->setNroEmpleadoR($nroEmpl);
		$this->setNroLicenciaR($nroLic);
		$this->setNombreR($nombre);
        $this->setApellidoR($apellido);
    }

    /**
	 * Recupera los datos del responsable por su numero de empleado 
	 * @param int $numE
	 * @return boolean 
	 */		
    public function BuscarResponsable($numE){
		$base = new BaseDatos();
		$consultaBusqueda = "SELECT * from responsable where rnumeroempleado=".$numE;
		$resp = false;

        if($base->Iniciar()){
			if($base->Ejecutar($consultaBusqueda)){
				if($row2 = $base->Registro()){					
				    $this->setNroEmpleadoR($numE);
					$this->setNroLicenciaR($row2['rnumerolicencia']);
					$this->setNombreR($row2['rnombre']);
					$this->setApellidoR($row2['rapellido']);
					$resp= true;
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
    public function InsertarResponsable(){
		$base = new BaseDatos();
		$resp = false;
		$consultaInsertar="INSERT INTO responsable(rnumeroempleado, rnumerolicencia, rnombre, rapellido) 
				VALUES (".$this->getNroEmpleadoR().",'".$this->getNroLicenciaR()."','".$this->getNombreR()."','".$this->getApellidoR()."')";
		
		if($base->Iniciar()){

			if($base->Ejecutar($consultaInsertar)){

			    $resp=  true;

			}	else {
					$this->setMensajeOperacion($base->getError());
					
			}

		} else {
				$this->setMensajeOperacion($base->getError());
			
		}
		return $resp;
	}


    /** Actualiza los datos de la tabla responsable en la base de datos que coincida con su numro de empleado
     * @param ()
     * @return boolean
    */
    public function ActualizarResponsable(){
	    $resp = false; 
	    $base = new BaseDatos();
		$consultaModifica="UPDATE responsable SET rnumerolicencia='".$this->getNroLicenciaR(). "',rnombre='".$this->getNombreR()."',rapellido='".$this->getApellidoR().
                           "' WHERE rnumeroempleado=". $this->getNroEmpleadoR();

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
    public function EliminarResponsable(){
		$base = new BaseDatos();
		$resp = false;

		if($base->Iniciar()){
				$consultaBorra="DELETE FROM responsable WHERE rnumeroempleado=".$this->getNroEmpleadoR();
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

	/**Lista todas los responsables que cumplen con cierta condicio 
	 * @param void 
     * @return array
	 */
	public function listar($condicion = ""){
	    $arregloResponsable = null;
		$base = new BaseDatos();
		$consultaResponsable = "SELECT * from responsable ";
		if ($condicion != ""){
		    $consultaResponsable = $consultaResponsable.' where '.$condicion;
		}
		$consultaResponsable.=" order by rnumeroempleado ";

		if($base->Iniciar()){
			if($base->Ejecutar($consultaResponsable)){				
				$arregloResponsable = array();
				while($row2 = $base->Registro()){
					
					$numResp = $row2['rnumeroempleado'];
					$numLic =  $row2['rnumerolicencia'];
					$rnombre = $row2['rnombre'];
					$rapellido =$row2['rapellido'];
				
					$resp = new responsable();
					$resp->cargar($numResp,$numLic,$rnombre,$rapellido);
					array_push($arregloResponsable,$resp);
	
				}
				
			
		 	}	else {
		 			$this->setMensajeOperacion($base->getError());
		 		
			}
		 }	else {
		 		$this->setMensajeOperacion($base->getError());
		 	
		 }	 
		 return $arregloResponsable;
	}	
}    

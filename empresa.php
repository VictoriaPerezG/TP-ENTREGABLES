<?php

class empresa{
    private $idempresa;
    private $enombre;
    private $edireccion;
	private $mensajeoperacion;

    public function __construct()
    {
        $this->idempresa = "";
		$this->enombre = "";
		$this->edireccion = "";
    }

    //metodos de acceso 
    public function getIdEmpresa(){
        return $this->idempresa;
    }
    public function setIdEmpresa($id){
        $this->idempresa = $id;
    }

    public function getENombre(){
        return $this->enombre;
    }
    public function setENombre($name){
        $this->enombre = $name;
    }

    public function getEDireccion(){
        return $this->edireccion;
    }
    public function setEDireccion($dire){
        $this->edireccion = $dire;
    }

	public function getMensajeOperacion(){
		return $this->mensajeoperacion ;
	}
	public function setMensajeOperacion($mensajeoperacion){
		$this->mensajeoperacion=$mensajeoperacion;
	}

    //FUNCIONES DE LA CLASE EMPRESA 

    public function cargar($idempresa,$enombre,$edireccion){		
		$this->setIdEmpresa($idempresa);
		$this->setENombre($enombre);
		$this->setEDireccion($edireccion);
    }

    /**
	 * Recupera los datos de una empresa por su id 
	 * @param int $id
	 * @return boolean
	 */		
    public function BuscarEmpresa($id){
		$base = new BaseDatos();
		$consultaBusqueda = "SELECT * from empresa where idempresa=".$id;
		$resp = false;

        if($base->Iniciar()){
			if($base->Ejecutar($consultaBusqueda)){
				if($row2 = $base->Registro()){					
				    $this->setIdEmpresa($id);
					$this->setENombre($row2['enombre']);
					$this->setEDireccion($row2['edireccion']);
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
    public function InsertarEmpresa(){
		$base = new BaseDatos();
		$resp = false;
		$consultaInsertar="INSERT INTO empresa(idempresa, enombre, edireccion) 
				VALUES (".$this->getIdEmpresa().",'".$this->getENombre()."','".$this->getEDireccion()."')";
		
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


    /** Actualiza los datos de la tabla empresa en la base de datos que coincida con su id
     * @param ()
     * @return boolean 
    */
    public function ActualizarEmpresa(){
	    $resp = false; 
	    $base = new BaseDatos();
		$consultaModifica="UPDATE empresa SET enombre='".$this->getENombre()."',edireccion='".$this->getEDireccion().
                           "'WHERE idempresa=". $this->getIdEmpresa();

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
    public function EliminarEmpresa(){
		$base = new BaseDatos();
		$resp = false;

		if($base->Iniciar()){
				$consultaBorra="DELETE FROM empresa WHERE idempresa=".$this->getIdEmpresa();
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

    public function __toString()
    {
        $cadena =" \nEMPRESA \n";
        $cadena .= "ID: " .$this->getIdEmpresa () ."\n" .
                   "NOMBRE: " .$this->getENombre () ."\n" .
                   "DIRECCION: " .$this->getEDireccion () ."\n" ;
        return $cadena;           
    }

    /**Lista todas las empresas que cumplen con cierta condicio 
	 * @param void 
     * @return array
	 */
	public function listar($condicion = ""){
	    $arregloEmpresa = null;
		$base=new BaseDatos();
		$consultaEmpresa="SELECT * from empresa ";
		if ($condicion != ""){
		    $consultaEmpresa = $consultaEmpresa.' where '.$condicion;
		}
		$consultaEmpresa.=" order by idempresa ";

		if($base->Iniciar()){
			if($base->Ejecutar($consultaEmpresa)){				
				$arregloEmpresa = array();
				while($row2 = $base->Registro()){
					
					$idempresa = $row2['idempresa'];
					$enombre = $row2['enombre'];
					$edireccion =$row2['edireccion'];
				
					$empresa = new empresa();
					$empresa->cargar($idempresa,$enombre,$edireccion);
					array_push($arregloEmpresa,$empresa);
	
				}
				
			
		 	}	else {
		 			$this->setMensajeOperacion($base->getError());
		 		
			}
		 }	else {
		 		$this->setMensajeOperacion($base->getError());
		 	
		 }	 
		 return $arregloEmpresa;
	}	


}
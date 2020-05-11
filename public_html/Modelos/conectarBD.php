<?php
$mysqli = new mysqli('localhost', 'root','', 'sistemahorario');

if(!$mysqli){
    die($mysqli->connect_error);
}

class Conexion
{
	private $server;
	private $user;
	private $password;
	private $bd;
	private $conexion;

	public function __construct()
	{
		$this->server="localhost";
		$this->user="root";
		$this->password="";
		$this->bd="sistemahorario";
		$this->conexion=new mysqli($this->server, $this->user,$this->password, $this->bd);
	}
	public function ejecutarConsulta($sql){

		$resultado=$this->conexion->query($sql);

		return $resultado;
	}

	public function ejecutarActualizacion($sql){

		$this->conexion->query($sql);

	}

	public function cerrarConexion(){

		$this->conexion->close();

	}

	public function getConexion(){

		return $this->conexion;
		
	}
}
?>
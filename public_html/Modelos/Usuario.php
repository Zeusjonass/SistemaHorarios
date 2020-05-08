<?php  

class Usuario
{
	private $id;
	private $password;
	private $rol;
	public function __construct($id,$password)
	{
		$this->id=$id;
		$this->password=$password;
		$this->rol="";
	}
	#Funciones setter
	public function setId($id){
		$this->id=$id;
	}

	public function setPassword($password){
		$this->password=$password;
	}

	public function setRol($rol){
		$this->rol=$rol;
	}
	
	#Funciones getter
	public function getId() {
		return $this->id;
	}

	public function getPassword() {
		return $this->password;
	}

	public function getRol() {
		return $this->rol;
	}
}
?>
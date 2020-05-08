<?php  
class Clase {
 
	private $idCurso;
	private $idSalon;
	private $Dia;
	private $HoraInicio;
	private $HoraFin;
 
	function __construct( $idCurso,$idSalon,$Dia,$HoraInicio,$HoraFin) {
		$this->idCurso = $idCurso;
		$this->idSalon = $idSalon;
		$this->Dia = $Dia;
		$this->HoraInicio = $HoraInicio;
		$this->HoraFin = $HoraFin;
	}

	function setIdCurso($id){
		$this->idCurso=$id;
	}
	function setIdSalon($id){
		$this->idSalon=$id;
	}
	function setDia($Dia){
		$this->Dia=$Dia;
	}
	function setHoraInicio($Hora){
		$this->HoraInicio=$Hora;
	}
	function setHoraFin($Hora){
		$this->HoraFin=$Hora;
	}

	function getIdCurso() {
		return $this->idCurso;
	}
	function getIdSalon() {
		return $this->idSalon;
	}
	function getDia() {
		return $this->Dia;
	}
	function getHoraInicio() {
		return $this->HoraInicio;
	}
	function getHoraFin() {
		return $this->HoraFin;
	} 
}

?>
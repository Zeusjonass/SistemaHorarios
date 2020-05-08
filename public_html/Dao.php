<?php 
	require 'conectarBD.php';

	class Dao
	{
		public function __construct(){}

		public function listarDatos( $tipo ){

			$conexion = new Conexion();

			switch ($tipo) {

				case 'vistaProfesor':

					$usuario=$_SESSION['username'];

					$sentencia_1="SELECT idProfesor FROM profesor where idUsuario='$usuario'";

			        $resultado2=$conexion->getConexion()->query($sentencia_1);

			        $idObtenido=$resultado2->fetch_array(MYSQLI_BOTH);

			        $query="SELECT NomProf,Dia,HoraInicio,HoraFin,DescSalon,DescMat 
			        from curso 
			        inner join profesor 
			        inner join clase 
			        inner join salon 
			        inner join materia 
			        on (curso.idCurso=clase.idCurso 
			        and curso.idProfesor=profesor.idProfesor 
			        and curso.idMateria=materia.idMateria 
			        and clase.idSalon=salon.idSalon)
			        where profesor.idProfesor= '$idObtenido[0]'";

					break;

				case 'vistaEstudiante':

					$usuario=$_SESSION['username'];

	 	            $sentencia_1="SELECT idAlumno,nomAlum FROM alumno where idUsuario='$usuario'";

	 	            $resultado2=$conexion->getConexion()->query($sentencia_1);

			        $idObtenido=$resultado2->fetch_array(MYSQLI_BOTH);

            		$query="SELECT nomAlum,DescMat,NomProf,Dia,HoraInicio,HoraFin,DescSalon 
            			FROM alumnoinscrito 
            			inner join curso 
            			inner join alumno 
                		inner join profesor 
                		inner join materia
                		inner join clase
                		inner join salon 
                		ON (curso.idCurso=alumnoinscrito.idCurso and alumno.idAlumno=alumnoinscrito.idAlumno and curso.idProfesor=profesor.idProfesor and curso.idMateria=materia.idMateria and curso.idCurso=clase.idCurso and clase.idSalon=salon.idSalon) where alumno.idAlumno='$idObtenido[0]'";

			 		break;

			 	case 'vistaAdminTabla':

			 	 	$query= "SELECT * from ((curso LEFT JOIN materia ON curso.idMateria = materia.idMateria) JOIN profesor ON curso.idProfesor = profesor.idProfesor) ORDER BY curso.idCurso ASC";
			 	 	
		 	 		break;

		 	 	case 'vistaAdminClases':

		 	 		$query= "SELECT DISTINCT clase.idCurso, clase.idSalon, salon.descSalon from (clase JOIN salon ON clase.idSalon = salon.idSalon) ORDER BY clase.idCurso ASC";
		 	 		
	 	 			break;

 	 			case 'vistaRegistrarGrupos':

 		            $query="SELECT curso.idCurso,NomMat,NomProf FROM curso 
	                inner join profesor 
	                inner join materia
	                ON (curso.idProfesor=profesor.idProfesor and curso.idMateria=materia.idMateria)";

 	 				break;

 	 			case 'vistaRegistrarSalones':

 	 				$query="SELECT * from salon";

 	 				break;

 	 			case 'horariosAdminCurso':

 	 				$cursoObtenido = $_SESSION['cursoObtenido'];

		            $query="SELECT * FROM curso 
		            inner join profesor 
		            inner join materia 
		            on (curso.idProfesor=profesor.idProfesor and curso.idMateria=materia.idMateria) 
		            where idCurso='$cursoObtenido'";

 	 				break;

 	 			case 'horariosAdmin':

 	 				$cursoObtenido = $_SESSION['cursoObtenido'];

		            $query = "SELECT idClase,NomProf,Dia,HoraInicio,HoraFin,DescSalon,DescMat 
		            from curso 
		            inner join profesor 
		            inner join clase 
		            inner join salon 
		            inner join materia 
		            on (curso.idCurso=clase.idCurso 
		            and curso.idProfesor=profesor.idProfesor 
		            and curso.idMateria=materia.idMateria 
		            and clase.idSalon=salon.idSalon) 
    		        where curso.idCurso=$cursoObtenido";;

 	 				break;

 	 			case 'editarClaseSalones':

 	 				$query = "SELECT * FROM salon";

 	 				break;

 	 			case 'editarClaseClaseElegida':

 	 				$claseElegida  = $_SESSION['claseEditar'];

 	 				$query = "SELECT * FROM clase where idClase='$claseElegida'";

 	 				break;

				default:
					
					break;
			}

			$data = $conexion->ejecutarConsulta($query);

			$conexion->cerrarConexion();

			return $data;
		
		}

		public function registrarClase( $clase ){

			function horarioDisponible( $horaInicioOld,$horaFinOld,$horaInicioNew,$horaFinNew ){

                $disponible = false;

                if( strtotime($horaInicioNew) >= strtotime($horaFinOld) ):

                    $disponible = true;

                endif;

                if( strtotime($horaFinNew) <= strtotime($horaInicioOld) ):

                    $disponible = true;

                endif;

                return $disponible;
            }

			$conexion = new Conexion();
			
			$clasesAsignadasDia=0;
            
            $aux=0;
            
            $SEGUNDOS2HORAS=7200;

            $strHoraInicio=strtotime($clase->getHoraInicio());
            
            $strHoraFin=strtotime($clase->getHoraFin());

            $queryClases="SELECT * FROM clase";

            $resultadoClases=$conexion->ejecutarConsulta($queryClases);

            $resultadoClases2=$conexion->ejecutarConsulta($queryClases);

            #validacion de que la hora final vaya despues de la hora inicio

            if( $strHoraFin <= $strHoraInicio ):

                header("location:registrarHorario.php?error=2");

            #validacion de que la diferencia de horas, no supere las 2 horas

            elseif( ( $strHoraFin-$strHoraInicio ) > $SEGUNDOS2HORAS):

                header("location:registrarHorario.php?error=1");

            else:
                
                while( $mostrar = mysqli_fetch_assoc($resultadoClases) ){

                    if($mostrar['Dia']==$clase->getDia() && $mostrar['idCurso']==$clase->getIdCurso()):

                        $clasesAsignadasDia +=1 ;

                    endif;
                }
                if($clasesAsignadasDia==0):

                    while ( $mostrar2 = mysqli_fetch_assoc($resultadoClases2) ) {

                        if($mostrar2['Dia']==$clase->getDia() && $mostrar2['idSalon']==$clase->getIdSalon()
                            && (!horarioDisponible($mostrar2['HoraInicio'],$mostrar2['HoraFin'],$clase->getHoraInicio(),$clase->getHoraFin()))):

                            $aux += 1;

                        endif;
                    }

                    if( $aux == 0 ):

                        $insertQuery = "INSERT INTO clase (idCurso,idSalon,Dia,HoraInicio,HoraFin) values 
                        ('".$clase->getIdCurso()."','".$clase->getIdSalon()."','".$clase->getDia()."','".$clase->getHoraInicio()."','".$clase->getHoraFin()."')";

                    	$data = $conexion->ejecutarActualizacion( $insertQuery );

                        header("location:registrarHorario.php?error=5");

                    else:

                        header("location:registrarHorario.php?error=4");

                    endif;

                else:

                    header("location:registrarHorario.php?error=3");

                endif;

            endif;

			$conexion->cerrarConexion();
		}

		public function login( $user ){

			session_start();

			$conexion = new Conexion();

			$usuario = $user->getId();

			$password = $user->getPassword();

			$query = "SELECT COUNT(*) as contar FROM usuarios where idUsuario = BINARY '$usuario' and Password = BINARY '$password' ";

			$bdconect=$conexion->getConexion()->query($query);

			$parametros=$bdconect->fetch_array(MYSQLI_BOTH);
 
			if( $parametros['contar']>0 ){

				$_SESSION['username'] = $usuario;

				$resultado = "SELECT Rol from usuarios where idUsuario='$usuario'";

				$bdconect2 = $conexion->getConexion()->query($resultado);

				$parametro=$bdconect2->fetch_array(MYSQLI_BOTH);

				$rol=$parametro[0];

				$_SESSION['rol']=$rol;

				$conexion->cerrarConexion();

				if($rol==1){

					header("location: vistaAdministrador.php");

				}elseif ($rol==2) {

					header("location: vistaProfesor.php");

				}else{

					header("location: vistaEstudiante.php");

				}
			}else {

			    header("location: login.php?error=1");

			}
		}

		public function borrarClase( $claseElegida ){

			$conexion = new Conexion();

			$clasesQuery = "SELECT * FROM clase where idClase='$claseElegida'";

			$queryResult = $conexion->ejecutarConsulta($clasesQuery);

			$datosObtenidos = mysqli_fetch_assoc($queryResult);

			$deleteQuery = "DELETE FROM clase where idClase='$claseElegida'";

        	$data = $conexion->ejecutarConsulta( $deleteQuery );

			if($data):

				header("location:vistaAdministrador.php");

			else:

				echo "Existio un error";

			endif;

		}
		public function editarClase( $clase ){

			function horarioDisponible($horaInicioOld,$horaFinOld,$horaInicioNew,$horaFinNew){

                $disponible=false;

                if( strtotime($horaInicioNew) >= strtotime($horaFinOld)):

                    $disponible = true;

                endif;

                if( strtotime($horaFinNew) <= strtotime($horaInicioOld)):

                    $disponible = true;

                endif;

                return $disponible;
            }

            $claseEditar = $_SESSION['claseEditar'];

			$conexion = new Conexion(); 

			$clasesAsigDia = 0;

            $aux = 0;

            $SEGUNDOS2HORAS = 7200;

            $strHoraInicio = strtotime($clase->getHoraInicio());

            $strHoraFin = strtotime($clase->getHoraFin());

            $sentenciaClases = "SELECT * from clase where idClase != $claseEditar";

            $resultadoClases = $conexion->ejecutarConsulta($sentenciaClases);

            $resultadoClases2 = $conexion->ejecutarConsulta($sentenciaClases);

            #validacion de que la hora final vaya despues de la hora inicio
            if( $strHoraFin <= $strHoraInicio ):

                header("location:vistaAdministrador.php?error=2");

            #validacion de que la diferencia de horas, no supere las 2 horas
            elseif( ($strHoraFin-$strHoraInicio) > $SEGUNDOS2HORAS ):

                header("location:vistaAdministrador.php?error=1");

            else:
                
                while( $mostrar = mysqli_fetch_assoc($resultadoClases) ){

                    if( $mostrar['Dia'] == $clase->getDia() && $mostrar['idCurso'] == $claseEditar):

                        $clasesAsigDia += 1;

                    endif;
                }

                if( $clasesAsigDia == 0 ):

                    while ( $mostrar2 = mysqli_fetch_assoc($resultadoClases2) ) {

                        if( $mostrar2['Dia'] == $clase->getDia() && $mostrar2['idSalon'] == $clase->getIdSalon()
                            && (!horarioDisponible($mostrar2['HoraInicio'],$mostrar2['HoraFin'],$clase->getHoraInicio(),$clase->getHoraFin()))):

                            $aux += 1;

                        endif;
                    }

                    if($aux == 0):

                        $updateQuery = "UPDATE clase set idSalon='".$clase->getIdSalon()."',Dia='".$clase->getDia()."',HoraInicio='".$clase->getHoraInicio()."',HoraFin='".$clase->getHoraFin()."' where idClase='".$claseEditar."'";

                    	$data = $conexion->ejecutarActualizacion( $updateQuery );

                        header("location:vistaAdministrador.php?error=5");

                    else:

                        header("location:vistaAdministrador.php?error=4");

                    endif;
                else:

                    header("location:vistaAdministrador.php?error=3");

                endif;

            endif;

            $conexion->cerrarConexion();

		}
	}
?>
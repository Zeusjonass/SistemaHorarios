<?php 
    session_start();
    $usuario= $_SESSION['username'];
    $rol=$_SESSION['rol'];
    $clase=$_SESSION['claseEditar'];
    if(!isset($usuario)):
        header("location:login.php");
    else:
        if($rol==1):
            require 'login//conexion.php';
            require 'classes/clase.php';

            #función encargada de determinar si el horario deseado está disponible con respecto a otro horario
            function horarioDisponible($horaInicioOld,$horaFinOld,$horaInicioNew,$horaFinNew){
                $disponible=false;
                if(strtotime($horaInicioNew)>=strtotime($horaFinOld)):
                    $disponible=true;
                endif;

                if(strtotime($horaFinNew)<=strtotime($horaInicioOld)):
                    $disponible=true;
                endif;

                return $disponible;
            }
        	$newDia=$_POST['dia'];
        	$newHoraInicio=$_POST['horaInicio'];
        	$newHoraFin=$_POST['horaFin'];
        	$newSalon=$_POST['salon'];

            $clasesAsigDia=0;
            $aux=0;
            $SEGUNDOS2HORAS=7200;
            $strHoraInicio=strtotime($newHoraInicio);
            $strHoraFin=strtotime($newHoraFin);
            $sentenciaClases="SELECT * from clase where idClase!=$clase";

            $resultadoClases=mysqli_query($conexion,$sentenciaClases);
            $resultadoClases2=mysqli_query($conexion,$sentenciaClases);

            #validacion de que la hora final vaya despues de la hora inicio
            if($strHoraFin<=$strHoraInicio):
                header("location:vistaAdministrador.php?error=2");

            #validacion de que la diferencia de horas, no supere las 2 horas
            elseif($strHoraFin-$strHoraInicio>$SEGUNDOS2HORAS):
                header("location:vistaAdministrador.php?error=1");
            else:
                
                while($mostrar=mysqli_fetch_array($resultadoClases)){
                    if($mostrar['Dia']==$newDia && $mostrar['idCurso']==$clase):
                        $clasesAsigDia+=1;
                    endif;
                }
                if($clasesAsigDia==0):
                    while ($mostrar2=mysqli_fetch_array($resultadoClases2)) {
                        if($mostrar2['Dia']==$newDia && $mostrar2['idSalon']==$clase
                            && (!horarioDisponible($mostrar2['HoraInicio'],$mostrar2['HoraFin'],$newHoraInicio,$newHoraFin))):
                            $aux+=1;
                        endif;
                    }

                    if($aux==0):
                        $updateQuery="UPDATE clase set idSalon='".$newSalon."',Dia='".$newDia."',HoraInicio='".$newHoraInicio."',HoraFin='".$newHoraFin."' where idClase='".$clase."'";
                        mysqli_query($conexion,$updateQuery);
                        header("location:vistaAdministrador.php?error=5");
                    else:
                        header("location:vistaAdministrador.php?error=4");
                    endif;
                else:
                    header("location:vistaAdministrador.php?error=3");
                endif;
            endif;
        else:
            header("location:cerrarSesion.php");
        endif;
    endif;
    ?>
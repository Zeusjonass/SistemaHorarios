 <?php 
    session_start();
    $usuario= $_SESSION['username'];
    if(!isset($usuario)):
        header("location:login.php");
    else:
        require 'login//conexion.php';
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

        $clasesAsigDia=0;
        $aux=0;
        $segundos2Horas=7200;
        $curso=$_POST['cursos'];
        $horaInicio=$_POST['horaInicio'];
        $horaFin=$_POST['horaFin'];
        $dia=$_POST['dia'];
        $salon=$_POST['salon'];
        $strHoraInicio=strtotime($horaInicio);
        $strHoraFin=strtotime($horaFin);
        $sentenciaClases="SELECT curso.idCurso,salon.idSalon,clase.Dia,clase.HoraInicio,clase.HoraFin FROM curso
        inner join clase
        inner join salon
        on (curso.idCurso=clase.idCurso and clase.idSalon=salon.idSalon)";
        $resultadoClases=mysqli_query($conexion,$sentenciaClases);
        $resultadoClases2=mysqli_query($conexion,$sentenciaClases);
        #validacion de que la hora final vaya despues de la hora inicio
        if($strHoraFin<=$strHoraInicio):
            header("location:registrarHorario.php?error=2");
        #validacion de que la diferencia de horas, no supere las 2 horas
        elseif($strHoraFin-$strHoraInicio>$segundos2Horas):
            header("location:registrarHorario.php?error=1");
        else:
            #
            while($mostrar=mysqli_fetch_array($resultadoClases)){
                if($mostrar['Dia']==$dia && $mostrar['idCurso']==$curso):
                    $clasesAsigDia+=1;
                endif;
            }
            if($clasesAsigDia==0):
                while ($mostrar2=mysqli_fetch_array($resultadoClases2)) {
                    if($mostrar2['Dia']==$dia && $mostrar2['idSalon']==$salon 
                        && (!horarioDisponible($mostrar2['HoraInicio'],$mostrar2['HoraFin'],$horaInicio,$horaFin))):
                        $aux+=1;
                    endif;
                }

                if($aux==0):
                    $insertQuery="INSERT INTO clase (idCurso,idSalon,Dia,HoraInicio,HoraFin) values ('$curso','$salon','$dia','$horaInicio','$horaFin')";
                    mysqli_query($conexion,$insertQuery);
                    header("location:registrarHorario.php?error=5");
                else:
                    header("location:registrarHorario.php?error=4");
                endif;
            else:
                header("location:registrarHorario.php?error=3");
            endif;
        endif;
    endif;
    ?>
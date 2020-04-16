 <?php 
    session_start();
    $usuario= $_SESSION['username'];
    if(!isset($usuario)):
        header("location:login.php");
    else:
        require 'login//conexion.php';
        function horarioDisponible($horaInicioOld,$horaFinOld,$horaInicioNew,$horaFinNew){
            $horaMayor=false;
            $horaMenor=false;
            if(strtoTime($horaInicioNew)>=strtoTime($horaFinOld)):
                $horaMayor=true;
            endif;

            if(strtoTime($horaFinNew)<=strtoTime($horaInicioOld)):
                $horaMenor=true;
            endif;

            if($horaMayor or $horaMenor):
                return true;
            else:
                return false;
            endif;
        }
        $clasesAsigDia=0;
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
        if($strHoraFin<=$strHoraInicio):
            header("location:registrarHorario.php?error=2");
        elseif($strHoraFin-$strHoraInicio>$segundos2Horas):
            header("location:registrarHorario.php?error=1");
        else:
            while($mostrar=mysqli_fetch_array($resultadoClases)){
                if($mostrar['Dia']==$dia and $mostrar['idCurso']==$curso):
                    $clasesAsigDia+=1;
                endif;
            }
            if($clasesAsigDia==0):
                while ($mostrar2=mysqli_fetch_array($resultadoClases2)) {
                    if($mostrar2['Dia']==$dia and $mostrar2['salon']==$salon and !horarioDisponible($horaInicio,$horaFin,$mostrar2['HoraInicio'],$mostrar2['HoraFin'])):
                        $clasesAsigDia+=1;
                    endif;   
                }
                if($clasesAsigDia==0):
                    $insertQuery="INSERT INTO clase (idCurso,idSalon,Dia,HoraInicio,HoraFin) values (".(int)$curso.",".(int)$salon.",".$dia.",".$horaInicio.",".$horaFin.")";
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
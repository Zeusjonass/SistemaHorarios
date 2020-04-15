 <?php 
    session_start();
    $usuario= $_SESSION['username'];
    if(!isset($usuario)):
        header("location:login.php");
    else:
        require 'login//conexion.php';
        $numCursos=0;
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

        if($strHoraFin<=$strHoraInicio):
            header("location:registrarHorario.php?error=2");
        elseif($strHoraFin-$strHoraInicio>7200):
            header("location:registrarHorario.php?error=1");
        else:
            while($mostrar=mysqli_fetch_array($resultadoClases)){
                if($mostrar['Dia']==$dia and $mostrar['idCurso']==$curso):
                    echo "No se puede tener 2 clases diferentes del mismo grupo en un solo día";
                else:

                endif;
            }
        endif;
    endif;

    ?>
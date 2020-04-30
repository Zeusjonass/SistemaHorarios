 <?php 
    session_start();
    $usuario= $_SESSION['username'];
    $rol=$_SESSION['rol'];
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

            $clasesAsigDia=0;
            $aux=0;
            $SEGUNDOS2HORAS=7200;
            $clase=new Clase($_POST['cursos'],$_POST['salon'],$_POST['dia'],$_POST['horaInicio'],$_POST['horaFin']);
            $strHoraInicio=strtotime($clase->getHoraInicio());
            $strHoraFin=strtotime($clase->getHoraFin());
            $sentenciaClases="SELECT * FROM clase";

            $resultadoClases=mysqli_query($conexion,$sentenciaClases);
            $resultadoClases2=mysqli_query($conexion,$sentenciaClases);

            #validacion de que la hora final vaya despues de la hora inicio
            if($strHoraFin<=$strHoraInicio):
                header("location:registrarHorario.php?error=2");

            #validacion de que la diferencia de horas, no supere las 2 horas
            elseif($strHoraFin-$strHoraInicio>$SEGUNDOS2HORAS):
                header("location:registrarHorario.php?error=1");
            else:
                
                while($mostrar=mysqli_fetch_array($resultadoClases)){
                    if($mostrar['Dia']==$clase->getDia() && $mostrar['idCurso']==$clase->getIdCurso()):
                        $clasesAsigDia+=1;
                    endif;
                }
                if($clasesAsigDia==0):
                    while ($mostrar2=mysqli_fetch_array($resultadoClases2)) {
                        if($mostrar2['Dia']==$clase->getDia() && $mostrar2['idSalon']==$clase->getIdSalon()
                            && (!horarioDisponible($mostrar2['HoraInicio'],$mostrar2['HoraFin'],$clase->getHoraInicio(),$clase->getHoraFin()))):
                            $aux+=1;
                        endif;
                    }

                    if($aux==0):
                        $insertQuery="INSERT INTO clase (idCurso,idSalon,Dia,HoraInicio,HoraFin) values 
                        ('".$clase->getIdCurso()."','".$clase->getIdSalon()."','".$clase->getDia()."','".$clase->getHoraInicio()."','".$clase->getHoraFin()."')";
                        mysqli_query($conexion,$insertQuery);
                        header("location:registrarHorario.php?error=5");
                    else:
                        header("location:registrarHorario.php?error=4");
                    endif;
                else:
                    header("location:registrarHorario.php?error=3");
                endif;
            endif;
        else:
            header("location:cerrarSesion.php");
        endif;
    endif;
    ?>
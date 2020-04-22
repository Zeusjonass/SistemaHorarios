<?php  
    session_start();
    $usuario= $_SESSION['username'];
    $rol=$_SESSION['rol'];
    if(!isset($usuario)){
        header("location:login.php");
?>
    <?php }else{
        require 'login//conexion.php';
        if($rol==3){
            $sentencia_1="SELECT idAlumno FROM alumno where idUsuario='$usuario'";
            $resultado2=mysqli_query($conexion,$sentencia_1);
            $idObtenido=mysqli_fetch_array($resultado2);
            $sentencia_2="SELECT nomAlum,DescMat,NomProf,Dia,HoraInicio,HoraFin,DescSalon 
            FROM alumnoinscrito 
                inner join curso 
                inner join alumno 
                inner join profesor 
                inner join materia
                inner join clase
                inner join salon 
                ON (curso.idCurso=alumnoinscrito.idCurso and alumno.idAlumno=alumnoinscrito.idAlumno and curso.idProfesor=profesor.idProfesor and curso.idMateria=materia.idMateria and curso.idCurso=clase.idCurso and clase.idSalon=salon.idSalon) where alumno.idAlumno='$idObtenido[0]'";
            $resultado=mysqli_query($conexion,$sentencia_2);
            $resultado2=mysqli_query($conexion,$sentencia_2);
            $resultado3=mysqli_query($conexion,$sentencia_2);
            $resultado4=mysqli_query($conexion,$sentencia_2);
            $resultado5=mysqli_query($conexion,$sentencia_2);
            $resultado6=mysqli_query($conexion,$sentencia_2);
            $nomAux=mysqli_fetch_array($resultado6);
            $nomAlum=$nomAux['nomAlum'];
    ?>
<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>Estudiante</title>
        <link rel="icon" href="img/uady.png" />
    </head>   
    <body>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <br>
                    <h4 class="d-inline">Bienvenido estudiante <?php echo "$nomAlum"; ?></h4>
                    <a href="cerrarSesion.php">
                    <button type="button" class="btn btn-dark btn-sm mb-2 float-right">Cerrar Sesión</button>
                    </a><br><br><br>
                </div>
            </div>
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-dark table-hover table-borderless">
                    <tr>
                        <th scope="col">Lunes</th>
                        <?php while($mostrar=mysqli_fetch_array($resultado)){ 
                            if($mostrar['Dia']=='Lunes'){
                                echo "<td scope='col'>Materia: ".$mostrar['DescMat']."<br>Profesor: ".$mostrar['NomProf']."<br>Hora Inicio: ".$mostrar['HoraInicio']."<br>Hora final: ".$mostrar['HoraFin']."<br>Salon: ".$mostrar['DescSalon']."</td>";
                            };
                        }?>
                    </tr>
                    <tr>
                        <th scope="col">Martes</th>
                        <?php while($mostrar2=mysqli_fetch_array($resultado2)){ 
                            if($mostrar2['Dia']=='Martes'){
                                echo "<td scope='col'>Materia: ".$mostrar2['DescMat']."<br>Profesor: ".$mostrar2['NomProf']."<br>Hora Inicio: ".$mostrar2['HoraInicio']."<br>Hora final: ".$mostrar2['HoraFin']."<br>Salon: ".$mostrar2['DescSalon']."</td>";
                            };
                        }?>
                    </tr>
                    <tr>
                        <th scope="col">Miércoles</th>
                        <?php while($mostrar3=mysqli_fetch_array($resultado3)){ 
                            if($mostrar3['Dia']=='Miercoles'){
                                echo "<td scope='col'>Materia: ".$mostrar3['DescMat']."<br>Profesor: ".$mostrar3['NomProf']."<br>Hora Inicio: ".$mostrar3['HoraInicio']."<br>Hora final: ".$mostrar3['HoraFin']."<br>Salon: ".$mostrar3['DescSalon']."</td>";
                            };
                        }?>
                    </tr>
                    <tr>
                        <th scope="col">Jueves</th>
                        <?php while($mostrar4=mysqli_fetch_array($resultado4)){ 
                            if($mostrar4['Dia']=='Jueves'){
                                echo "<td scope='col'>Materia: ".$mostrar4['DescMat']."<br>Profesor: ".$mostrar4['NomProf']."<br>Hora Inicio: ".$mostrar4['HoraInicio']."<br>Hora final: ".$mostrar4['HoraFin']."<br>Salon: ".$mostrar4['DescSalon']."</td>";
                            };
                        }?>
                    </tr>
                    <tr>
                        <th scope="col">Viernes</th>
                        <?php while($mostrar5=mysqli_fetch_array($resultado5)){ 
                            if($mostrar5['Dia']=='Viernes'){
                                echo "<td scope='col'>Materia: ".$mostrar5['DescMat']."<br>Profesor: ".$mostrar5['NomProf']."<br>Hora Inicio: ".$mostrar5['HoraInicio']."<br>Hora final: ".$mostrar5['HoraFin']."<br>Salon: ".$mostrar5['DescSalon']."</td>";
                            };
                        }?>
                    </tr>  
                    </table>    
                </div>
            </div>
        </div>
    </body>
</html>
    <?php }else{
        header("location:cerrarSesion.php");
    } }?>
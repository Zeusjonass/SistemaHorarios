<?php  ?>
<?php  
    session_start();
    $cursoObtenido= $_GET['id'];
    $rol=$_SESSION['rol'];
    if(!isset($cursoObtenido)){
        header("location:login.php");
    }else{
        require 'login//conexion.php';
        if($rol==1){
        $cursoSql="SELECT * FROM curso where idCurso='$cursoObtenido'";
        $cursoResult=mysqli_query($conexion,$cursoSql);
        $idObtenido=mysqli_fetch_array($cursoResult);
        $idCurso=$idObtenido['idCurso'];

        $sentencia_2="SELECT NomProf,Dia,HoraInicio,HoraFin,DescSalon,DescMat 
        from curso 
        inner join profesor 
        inner join clase 
        inner join salon 
        inner join materia 
        on (curso.idCurso=clase.idCurso 
        and curso.idProfesor=profesor.idProfesor 
        and curso.idMateria=materia.idMateria 
        and clase.idSalon=salon.idSalon) 
        where curso.idCurso=$cursoObtenido";
        $resultado=mysqli_query($conexion,$sentencia_2);
        $resultado2=mysqli_query($conexion,$sentencia_2);
        $resultado3=mysqli_query($conexion,$sentencia_2);
        $resultado4=mysqli_query($conexion,$sentencia_2);
        $resultado5=mysqli_query($conexion,$sentencia_2);
        $resultado6=mysqli_query($conexion,$sentencia_2);
        $nomAux=mysqli_fetch_array($resultado6);
    ?>
<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <script src="js/script.js"></script>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>horarios</title>
        <link rel="icon" href="img/uady.png" />
    </head>   
    <body>
        <div class="container-fluid ">
        	<div class="row">
        		<div class="col-12 text-center">
                    <br>
                    <a href="vistaAdministrador.php">
                    <button type="button" class="btn btn-dark btn-sm mb-2 float-left">Regresar</button>
                    </a>
        			<h4 class="titulo d-inline">Información del grupo <?php echo $cursoObtenido;?></h4>
        		</div>
        	</div>
        	<div class="row justify-content-center">
        		<div class="col-6 text-center">
        			<p>Profesor: <?php echo $nomAux['NomProf']; ?></p>
        			<p>Materia: <?php echo $nomAux['DescMat']; ?></p>
        		</div>
        	</div>
            <div class="row justify-content-center">
                <div class="col-12 text-center table-responsive">
                    <form action="modificarHorario.php">
                    <table class="table table-dark table-hover table-borderless">
                        <tr>
                            <th scope="col">Lunes</th>
                            <?php while($mostrar=mysqli_fetch_array($resultado)){ 
                                if($mostrar['Dia']=='Lunes'){
                                    echo "<td scope='col'>";
                                    echo "<label>";
                                    echo "<input type='radio' name='grupoElegido' required><br>";
                                    echo "Materia: ".$mostrar['DescMat']."<br>Profesor: ".$mostrar['NomProf']."<br>Hora Inicio: ".$mostrar['HoraInicio']."<br>Hora final: ".$mostrar['HoraFin']."<br>Salon: ".$mostrar['DescSalon'];
                                    echo "</label>";
                                    echo "</td>";
                                    
                                };
                            }?>
                        </tr>
                        <tr>
                            <th scope="col">Martes</th>
                            <?php while($mostrar2=mysqli_fetch_array($resultado2)){ 
                                if($mostrar2['Dia']=='Martes'){
                                	echo "<td scope='col'>";
                                    echo "<label>";
                                    echo "<input type='radio' name='grupoElegido' required><br>";
                                    echo "Materia: ".$mostrar2['DescMat']."<br>Profesor: ".$mostrar2['NomProf']."<br>Hora Inicio: ".$mostrar2['HoraInicio']."<br>Hora final: ".$mostrar2['HoraFin']."<br>Salon: ".$mostrar2['DescSalon'];
                                    echo "</label>";
                                    echo "</td>";
                                };
                            }?>
                        </tr>
                        <tr>
                            <th scope="col">Miércoles</th>
                            <?php while($mostrar3=mysqli_fetch_array($resultado3)){ 
                                if($mostrar3['Dia']=='Miercoles'){
                                	echo "<td scope='col'>";
                                    echo "<label>";
                                    echo "<input type='radio' name='grupoElegido' required><br>";
                                    echo "Materia: ".$mostrar3['DescMat']."<br>Profesor: ".$mostrar3['NomProf']."<br>Hora Inicio: ".$mostrar3['HoraInicio']."<br>Hora final: ".$mostrar3['HoraFin']."<br>Salon: ".$mostrar3['DescSalon'];
                                    echo "</label>";
                                    echo "</td>";
                                };
                            }?>
                        </tr>
                        <tr>
                            <th scope="col">Jueves</th>
                            <?php while($mostrar4=mysqli_fetch_array($resultado4)){ 
                                if($mostrar4['Dia']=='Jueves'){
                            		echo "<td scope='col'>";
                                    echo "<label>";
                                    echo "<input type='radio' name='grupoElegido' required><br>";
                                    echo "Materia: ".$mostrar4['DescMat']."<br>Profesor: ".$mostrar4['NomProf']."<br>Hora Inicio: ".$mostrar4['HoraInicio']."<br>Hora final: ".$mostrar4['HoraFin']."<br>Salon: ".$mostrar4['DescSalon'];
                                    echo "</label>";
                                    echo "</td>";
                                };
                            }?>
                        </tr>
                        <tr>
                            <th scope="col">Viernes</th>
                            <?php while($mostrar5=mysqli_fetch_array($resultado5)){ 
                                if($mostrar5['Dia']=='Viernes'){
                                	echo "<td scope='col'>";
                                    echo "<label>";
                                    echo "<input type='radio' name='grupoElegido' required><br>";
                                    echo "Materia: ".$mostrar5['DescMat']."<br>Profesor: ".$mostrar5['NomProf']."<br>Hora Inicio: ".$mostrar5['HoraInicio']."<br>Hora final: ".$mostrar5['HoraFin']."<br>Salon: ".$mostrar5['DescSalon'];
                                    echo "</label>";
                                    echo "</td>";
                                };
                            }?>
                        </tr>
                    </table>
                    <button type="submit" class="btn btn-danger btn-md ">Borrar</button>
                    <button type="submit" class="btn btn-success btn-md ">Editar</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
    <?php }else{
        header("location:cerrarSesion.php");
    } }?>

        
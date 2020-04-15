<?php  
    session_start();
    $usuario= $_SESSION['username'];
    if(!isset($usuario)){
        header("location:login.php");
?>
    <?php }else{
        require 'login//conexion.php';
            $sentencia="SELECT curso.idCurso,NomMat,NomProf 
            FROM curso 
                inner join profesor 
                inner join materia
                ON (curso.idProfesor=profesor.idProfesor and curso.idMateria=materia.idMateria)";
            $resultado=mysqli_query($conexion,$sentencia);
            $sentencia2="SELECT * from salon";
            $resultado2=mysqli_query($conexion,$sentencia2);
    ?>
<html> 
    <head>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>Registrar horario</title>
        <script>
            function errorMessage(num){
                if(num==1){
                    alert("Las clases deben durar 2 horas o menos");
                }else if(num==2){
                    alert("La hora final debe ir despues de la hora de inicio");
                }
            }
        </script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <h3>Registrar un horario</h3><br>
                </div>
            </div>
            <div class="row">
                <div class="col-12" style="text-align: center;">
                <form action="registrar.php" method="POST">
                <table class="table table-dark table-hover table-borderless">
                    <tr style="text-align: center;">
                        <th>Grupos Existentes</th>
                    </tr>
                    <?php while($mostrar=mysqli_fetch_array($resultado)){ 
                    
                    echo "<tr style='text-align: justify;border:1px solid black'>";
                    echo "<td scope='col' style='text-align:center;'>";
                    echo "<label>";
                    echo "<input type='radio' value=".$mostrar['idCurso']." name='cursos' required><br>";
                    echo "<div>Id curso: ".$mostrar['idCurso']."<br>Profesor: ".$mostrar['NomProf']."<br>Materia: ".$mostrar['NomMat']."</div>";
                    echo "</label>"; 
                    echo "</td>";
                    echo "</tr>";
                    
                    }?>
                </table><br>
                <label>Hora inicio: <input type="time" name="horaInicio" min="07:00"  max="21:00" required="true" step="1800"></label><br>
                <label>Hora Fin: <input type="time" name="horaFin" required="true" min="07:00"  max="21:00" step="1800"></label><br>
                <label>Día: 
                    <select name="dia" required="true">
                        <option value="Lunes">Lunes</option>
                        <option value="Martes">Martes</option>
                        <option value="Miercoles">Miércoles</option>
                        <option value="Jueves">Jueves</option>
                        <option value="Viernes">Viernes</option>
                    </select>
                </label><br>
                <label>Salón: 
                    <select name="salon" required="true">
                        <?php while($salones=mysqli_fetch_array($resultado2)){
                            echo "<option value=".$salones['idSalon'].">".$salones['DescSalon']."</option> ";
                        } 
                        ?>
                    </select>
                </label><br>
                <input class="btn btn-dark"type="submit" value="Guardar horario">
                </form>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-6 text-center">
                <a href="vistaAdministrador.php" class="btn btn-dark">Regresar</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <?php
                if (isset($_GET['error'])) {
                    
                    if($_GET['error']=="1"){
                ?>
                <script type="text/javascript">
                    errorMessage(1);
                </script>
                <?php
                    } 
                    elseif ($_GET['error']=="2"){
                ?>
                <script type="text/javascript">
                    errorMessage(2);
                </script>
                <?php  
                    }
                }
                ?>
            </div>
        </div>
        </div>
    </body> 
</html>
<?php }?>

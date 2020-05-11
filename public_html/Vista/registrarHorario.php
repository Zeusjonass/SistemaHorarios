 <?php  
    session_start();
    $usuario= $_SESSION['username'];
    $rol=$_SESSION['rol'];
    if(!isset($usuario)){
        header("location:login.php");
    }else{
        require '../Controlador/Dao.php';

        if ($rol==1) {

            $dao = new Dao();

            $dataGrupos = $dao->listarDatos('vistaRegistrarGrupos');

            $dataSalones= $dao->listarDatos('vistaRegistrarSalones');
    ?>
<html> 
    <head>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/registrarHorario.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
        
        <title>Registrar horario</title>
        <link rel="icon" href="../img/uady.png" />
        <script>
            function errorMessage(num){
                if( num==1 ){
                    
                    alert("Las clases deben durar 2 horas o menos");
                }else if( num==2 ){

                    alert("La hora final debe ir despues de la hora de inicio");
                }else if( num==3 ){

                    alert("No pueden haber 2 clases del mismo grupo el mismo día");
                }else if( num==4 ){

                    alert("Otro grupo tiene el horario deseado");
                }else if( num==5 ){

                    alert("Se agregó el horario de manera correcta");
                }
            }
        </script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 header text-center mt-3 mb-3">
                    <h3>Registrar un horario</h3>
                <a href="vistaAdministrador.php" class="btn btn-dark float-left">Regresar</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                <form action="../Controlador/controlador.php?action=registrar" method="POST">
                <table class="table">
                    <tr style="text-align: center;">
                        <th>Grupos Existentes</th>
                    </tr>
                    <?php while($mostrar=mysqli_fetch_assoc($dataGrupos)){ 
                    
                    echo "<tr>";
                    echo "<td scope='col' style='text-align:center;'>";
                    echo "<label>";
                    echo "<input type='radio' value=".$mostrar['idCurso']." name='cursos' required><br>";
                    echo "<div>Id curso: ".$mostrar['idCurso']."<br>Profesor: ".$mostrar['NomProf']."<br>Materia: ".$mostrar['NomMat']."</div>";
                    echo "</label>"; 
                    echo "</td>";
                    echo "</tr>";
                    
                    }?>
                </table>
                <div class="formulario">
                    <div>
                        <label>Hora inicio: <input type="time" name="horaInicio" min="07:00"  max="21:00" required="true" step="1800"></label>
                    </div>
                    <div>
                        <label>Hora Fin: <input type="time" name="horaFin" required="true" min="07:00"  max="21:00" step="1800"></label>
                    </div>
                    <div>
                    <label>Día: 
                        <select name="dia" required="true">
                            <option value="Lunes">Lunes</option>
                            <option value="Martes">Martes</option>
                            <option value="Miercoles">Miércoles</option>
                            <option value="Jueves">Jueves</option>
                            <option value="Viernes">Viernes</option>
                        </select>
                    </label>
                    </div>
                    <div>
                    <label>Salón: 
                        <select name="salon" required="true">
                            <?php while($salones=mysqli_fetch_assoc($dataSalones)){
                                echo "<option value=".$salones['idSalon'].">".$salones['DescSalon']."</option> ";
                            } 
                            ?>
                        </select>
                    </label>
                    </div>
                    <div>
                        <input class="btn btn-dark"type="submit" value="Guardar horario">
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <?php
                if (isset($_GET['error'])) {
                    $num=$_GET['error'];
                ?>
                <script type="text/javascript">
                    errorMessage(<?php echo $num; ?>);
                </script>
                <?php } ?>
            </div>
        </div>
        </div>
    </body> 
</html>
<?php 
    }else{ 
        header("location:../Modelos/cerrarSesion.php"); 
    }
}?>

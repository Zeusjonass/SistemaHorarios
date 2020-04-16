<?php  
    session_start();
    $usuario= $_SESSION['username'];
    if(!isset($usuario)){
        header("location:login.php");
    }else{
        require 'conectarBD.php';
?>
<html>
    <head>
        <title>Administrador</title>
        <script src="js/script.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css"> 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
        <link rel="stylesheet" href="tablesort.css">
    </head>   

    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <br>
                    <h4 class="titulo d-inline">Bienvenido administrador <?php echo "$usuario"; ?></h4>
                    <a href="cerrarSesion.php" class="cerrarSesionBtn">
                    <button type="button" class="btn btn-dark btn-sm mr-3" id="out_sesion">Cerrar Sesión</button></a><br><br><br>
                </div>
            </div>
            <div class = "row">
                <table class = "table table-sortable">
                    <thead>
                        <tr>
                            <th>Profesor</th>
                            <th>Materia</th>
                            <th>Aula</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $tabla = "SELECT * from ((curso LEFT JOIN materia ON curso.idMateria = materia.idMateria) JOIN profesor ON curso.idProfesor = profesor.idProfesor) ORDER BY curso.idCurso ASC";
                        //$clases = "SELECT * from ((clase LEFT JOIN salon ON clase.idSalon = salon.idSalon)) ORDER BY clase.idCurso ASC";
                        // Test
			$clases = "SELECT DISTINCT clase.idCurso, clase.idSalon, salon.descSalon from (clase JOIN salon ON clase.idSalon = salon.idSalon) ORDER BY clase.idCurso ASC";
                        $res_tablas = $mysqli->query($tabla);
                        $res_clases = $mysqli->query($clases);
                        
                        foreach ($res_tablas as $row){?> 
                            <tr>
                                <td><?php echo $row['NomProf'] ?></td>
                                <td><?php echo $row['NomMat'] ?></td>
                                <td>
                                <?php 
                                foreach ($res_clases as $row2){
                                    ?><?php
                                    if($row2['idCurso'] == $row['idCurso']){
                                        echo "-".$row2['descSalon'];
                                        
                                    }
                                }
                                ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <a href="registrarHorario.php"><button type="submit" class="btn btn-dark btn-md text-center">Registrar Nuevo Horario</button></a>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src = "./tablesort.js"></script>
    </body>
</html>
<?php } ?>
<?php  
    session_start();
    $usuario= $_SESSION['username'];
    if(!isset($usuario)){
        header("location:login.php");
    }else{
        require ('conectarBD.php');
?>
<html>
    <head>
        <title>Adminsitrador</title>
        <script src="js/script.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
        <link rel="stylesheet" href="tablesort.css">
    </head>   

    <body>
        <a href="cerrarSesion.php" class="cerrarSesionBtn">
            <button type="button" class="btn btn-primary btn-lg" id="out_sesion">Cerrar Sesión</button></a><br>
        <h4 class="titulo">Bienvenido administrador <?php echo "$usuario"; ?></h4><br><br>
        

        <div class="container-fluid">
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
                        foreach ($mysqli->query('SELECT profesor.NomProf, salon.DescSalon, materia.NomMat from ((((clase JOIN salon ON clase.idSalon = salon.idSalon) JOIN curso ON clase.idCurso = curso.idCurso) JOIN profesor on curso.idProfesor = profesor.idProfesor) JOIN materia ON curso.idMateria = materia.idMateria)') as $row){?> 
                            <tr>
                                <td><?php echo $row['NomProf'] ?></td>
                                <td><?php echo $row['NomMat'] ?></td>
                                <td><?php echo $row['DescSalon'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <a><button type="submit" class="btn btn-primary btn-lg text-center">Registrar Nuevo Horario</button></a>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src = "./tablesort.js"></script>
    </body>
</html>
<?php } ?>
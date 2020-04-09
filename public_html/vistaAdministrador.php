<?php  
    session_start();
    $usuario= $_SESSION['username'];
    if(!isset($usuario)){
        header("location:login.php");
?>
<?php }else{?>
<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <script src="js/script.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>Adminsitrador</title>
    </head>   
    <body>
        <a href="cerrarSesion.php" class="cerrarSesionBtn">
            <button type="button" class="btn btn-primary btn-lg" id="out_sesion">Cerrar Sesión</button></a><br>
        <h4 class="titulo">Bienvenido administrador <?php echo "$usuario"; ?></h4><br><br>
        <a>Ordenar por:</a><br>
        <select name="orden">
        <option>Profesor</option>
        <option>Materia</option>
        <option>Aula</option>
        </select><br><br>
        <table class="table">
            <tr>
                <th scope="col">Profesor</th>
                <th scope="col">Materia</th>
                <th scope="col">Aula</th>
            </tr>
            <tbody>

            </tbody>
        </table><br>
        <a><button type="submit" class="btn btn-primary btn-lg text-center">Registrar Nuevo Horario</button></a>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
<?php } ?>
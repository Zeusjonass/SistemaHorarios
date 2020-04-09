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
        <title>Profesor</title>
    </head>   
    <body>
        <a href="cerrarSesion.php" class="cerrarSesionBtn">
            <button type="button" class="btn btn-primary btn-lg" id="out_sesion">Cerrar Sesión</button></a><br>
        <h4 class="titulo">Bienvenido profesor <?php echo "$usuario"; ?></h4><br><br>
        <table class="table">
            <tr>
                <th scope="col">Lunes</th>
                <th scope="col">Martes</th>
                <th scope="col">Miércoles</th>
                <th scope="col">Jueves</th>
                <th scope="col">Viernes</th>
            </tr>
            <tbody>

            </tbody>
        </table><br>
    </body>
</html>
    <?php } ?>


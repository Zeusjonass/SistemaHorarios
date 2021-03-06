<?php
    session_start();

    $usuario = $_SESSION['username'];

    $rol=$_SESSION['rol'];

    if(!isset($usuario)){

        header("location:login.php");

    } else {

        require '../Controlador/Dao.php';

        if ($rol==3) {

            $dao=new Dao();
            $datosLunes = $dao->listarDatos('vistaEstudiante');

            $datosMartes = $dao->listarDatos('vistaEstudiante');

            $datosMiercoles = $dao->listarDatos('vistaEstudiante');

            $datosJueves = $dao->listarDatos('vistaEstudiante');

            $datosViernes = $dao->listarDatos('vistaEstudiante');

            $nombre = $dao->obtenerDato("NomAlum","alumno","idUsuario",$usuario);
    ?>
<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/vistaEstudiante.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
        
        <title>Estudiante</title>
        <link rel="icon" href="../img/uady.png" />
    </head>   
    <body>
        <div class="container-fluid">
            <header class="row justify-content-center">
                <div class="col-12 text-center mt-3">
                    <h4>Bienvenido estudiante <?php echo "$nombre"; ?></h4>
                    <a href="../Modelos/cerrarSesion.php">
                    <button type="button" class="btn btn-dark btn-sm mb-5 float-right">Cerrar Sesión</button>
                    </a>
                </div>
            </header>

            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table">
                    <tr>
                        <th scope="col">Lunes</th>
                        <?php 
                            while ($rowHorario = mysqli_fetch_assoc($datosLunes)) {
                                if ($rowHorario['Dia']=='Lunes') {
                                    echo "<td scope='col'>Materia: ".$rowHorario['DescMat']."<br>Profesor: ".$rowHorario['NomProf']."<br>Hora Inicio: ".$rowHorario['HoraInicio']."<br>Hora final: ".$rowHorario['HoraFin']."<br>Salon: ".$rowHorario['DescSalon']."</td>";
                                }
                            }
                        ?>
                    </tr>
                    <tr>
                        <th scope="col">Martes</th>
                        <?php
                            while ($rowHorario = mysqli_fetch_assoc($datosMartes)) {
                                if ($rowHorario['Dia']=='Martes') {
                                    echo "<td scope='col'>Materia: ".$rowHorario['DescMat']."<br>Profesor: ".$rowHorario['NomProf']."<br>Hora Inicio: ".$rowHorario['HoraInicio']."<br>Hora final: ".$rowHorario['HoraFin']."<br>Salon: ".$rowHorario['DescSalon']."</td>";
                                }
                            }
                        ?>
                    </tr>
                    <tr>
                        <th scope="col">Miércoles</th>
                        <?php
                            while ($rowHorario = mysqli_fetch_assoc($datosMiercoles)) {
                                if ($rowHorario['Dia']=='Miercoles') {
                                    echo "<td scope='col'>Materia: ".$rowHorario['DescMat']."<br>Profesor: ".$rowHorario['NomProf']."<br>Hora Inicio: ".$rowHorario['HoraInicio']."<br>Hora final: ".$rowHorario['HoraFin']."<br>Salon: ".$rowHorario['DescSalon']."</td>";
                                }
                            }
                        ?>
                    </tr>
                    <tr>
                        <th scope="col">Jueves</th>
                       <?php
                            while ($rowHorario = mysqli_fetch_assoc($datosJueves)) {
                                if ($rowHorario['Dia']=='Jueves') {
                                    echo "<td scope='col'>Materia: ".$rowHorario['DescMat']."<br>Profesor: ".$rowHorario['NomProf']."<br>Hora Inicio: ".$rowHorario['HoraInicio']."<br>Hora final: ".$rowHorario['HoraFin']."<br>Salon: ".$rowHorario['DescSalon']."</td>";
                                }
                            }
                        ?>
                    </tr>
                    <tr>
                        <th scope="col">Viernes</th>
                       <?php
                            while ($rowHorario = mysqli_fetch_assoc($datosViernes)) {
                                if ($rowHorario['Dia']=='Viernes') {
                                    echo "<td scope='col'>Materia: ".$rowHorario['DescMat']."<br>Profesor: ".$rowHorario['NomProf']."<br>Hora Inicio: ".$rowHorario['HoraInicio']."<br>Hora final: ".$rowHorario['HoraFin']."<br>Salon: ".$rowHorario['DescSalon']."</td>";
                                }
                            }
                        ?>
                    </tr>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
    <?php } else {
        header("location:../Modelos/cerrarSesion.php");
    } }?>
    
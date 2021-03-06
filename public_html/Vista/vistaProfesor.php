<?php  
    session_start();

    $usuario= $_SESSION['username'];

    $rol=$_SESSION['rol'];

    if(!isset($usuario)){

        header("location:login.php");

    }else{
        
        require '../Controlador/Dao.php';
        
        if($rol==2){

            $dao=new Dao();

            $datosLunes=$dao->listarDatos('vistaProfesor');

            $datosMartes=$dao->listarDatos('vistaProfesor');

            $datosMiercoles=$dao->listarDatos('vistaProfesor');

            $datosJueves=$dao->listarDatos('vistaProfesor');
            
            $datosViernes=$dao->listarDatos('vistaProfesor');

            $nombre = $dao->obtenerDato("NomProf","profesor","idUsuario",$usuario);
    ?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/vistaProfesor.css">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
        <title>Profesor</title>
        <link rel="icon" href="../img/uady.png" />
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    </head>   
    <body>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 text-center header mb-5 mt-3">
                    <h4 class="">Bienvenido profesor <?php echo "$nombre"; ?></h4>
                    <a href="../Modelos/cerrarSesion.php">
                    <button type="button" class="btn btn-dark btn-sm  float-right">Cerrar Sesión</button>
                    </a>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 table-responsive">
                    <table class="table">
                        <tr>
                            <th scope="col">Lunes</th>
                            <?php 
                                while ($rowHorarios=mysqli_fetch_assoc($datosLunes)) {
                                if ($rowHorarios['Dia']=='Lunes') {
                                    echo "<td scope='col'>Materia: ".$rowHorarios['DescMat']."<br>Profesor: ".$rowHorarios['NomProf']."<br>Hora Inicio: ".$rowHorarios['HoraInicio']."<br>Hora final: ".$rowHorarios['HoraFin']."<br>Salon: ".$rowHorarios['DescSalon']."</td>";
                                };
                            }
                            ?>
                        </tr>
                        <tr>
                            <th scope="col">Martes</th>
                            <?php 
                                while ($rowHorarios=mysqli_fetch_assoc($datosMartes)) {
                                if ($rowHorarios['Dia']=='Martes') {
                                    echo "<td scope='col'>Materia: ".$rowHorarios['DescMat']."<br>Profesor: ".$rowHorarios['NomProf']."<br>Hora Inicio: ".$rowHorarios['HoraInicio']."<br>Hora final: ".$rowHorarios['HoraFin']."<br>Salon: ".$rowHorarios['DescSalon']."</td>";
                                };
                            }
                            ?>
                        </tr>
                        <tr>
                            <th scope="col">Miércoles</th>
                            <?php while ($rowHorarios=mysqli_fetch_assoc($datosMiercoles)) {
                                if ($rowHorarios['Dia']=='Miercoles') {
                                    echo "<td scope='col'>Materia: ".$rowHorarios['DescMat']."<br>Profesor: ".$rowHorarios['NomProf']."<br>Hora Inicio: ".$rowHorarios['HoraInicio']."<br>Hora final: ".$rowHorarios['HoraFin']."<br>Salon: ".$rowHorarios['DescSalon']."</td>";
                                };
                            }
                            ?>
                        </tr>
                        <tr>
                            <th scope="col">Jueves</th>
                            <?php 
                                while ($rowHorarios=mysqli_fetch_assoc($datosJueves)) {
                                if ($rowHorarios['Dia']=='Jueves') {
                                    echo "<td scope='col'>Materia: ".$rowHorarios['DescMat']."<br>Profesor: ".$rowHorarios['NomProf']."<br>Hora Inicio: ".$rowHorarios['HoraInicio']."<br>Hora final: ".$rowHorarios['HoraFin']."<br>Salon: ".$rowHorarios['DescSalon']."</td>";
                                };
                            }
                            ?>
                        </tr>
                        <tr>
                            <th scope="col">Viernes</th>
                            <?php 
                                while ($rowHorarios=mysqli_fetch_assoc($datosViernes)) {
                                if ($rowHorarios['Dia']=='Viernes') {
                                    echo "<td scope='col'>Materia: ".$rowHorarios['DescMat']."<br>Profesor: ".$rowHorarios['NomProf']."<br>Hora Inicio: ".$rowHorarios['HoraInicio']."<br>Hora final: ".$rowHorarios['HoraFin']."<br>Salon: ".$rowHorarios['DescSalon']."</td>";
                                };
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

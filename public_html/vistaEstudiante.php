<?php  
    session_start();

    $usuario= $_SESSION['username'];

    $rol=$_SESSION['rol'];

    if(!isset($usuario)){

        header("location:login.php");

    }else{

        require 'Dao.php';

        if($rol==3){

            $dao=new Dao();
            $datosLunes=$dao->listarDatos('vistaEstudiante');
            $datosMartes=$dao->listarDatos('vistaEstudiante');
            $datosMiercoles=$dao->listarDatos('vistaEstudiante');
            $datosJueves=$dao->listarDatos('vistaEstudiante');
            $datosViernes=$dao->listarDatos('vistaEstudiante');
    ?>
<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <link rel="stylesheet" type="text/css" href="css/vistaEstudiante.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>Estudiante</title>
        <link rel="icon" href="img/uady.png" />
        <style>
            *{
                margin: 0;
                padding: 0;
            }
            body{
                background: url('img/schedule.jpg') no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                background-size: cover;
                -o-background-size: cover;
                backdrop-filter: blur(4px);
            }
            header{
                color: white;
            }
            header h4{
                text-shadow: #474747 3px 5px 2px;
                border-radius: 10px;
                box-shadow: 0px 0px 30px 0px rgba(0,0,0,0.61);
                padding: 5px;
            }
            .table{
                background-color: rgba(0,0,0,.8);
                border-radius: 15px;
                color: white;
            }
            .table tr:hover{
                cursor: pointer;
                background-color: rgba(0,0,0,.9);
            }
        </style>
    </head>   
    <body>
        <div class="container-fluid">
            <header class="row justify-content-center">
                <div class="col-12 text-center mt-3">
                    <h4>Bienvenido estudiante <?php echo "$nomAlum"; ?></h4>
                    <a href="cerrarSesion.php">
                    <button type="button" class="btn btn-dark btn-sm mb-2 float-right">Cerrar Sesión</button>
                    </a><br><br><br>
                </div>
            </header>

            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-borderless">
                    <tr>
                        <th scope="col">Lunes</th>
                        <?php 
                            while ($row = mysqli_fetch_assoc($datosLunes)) {
                                if($row['Dia']=='Lunes'){
                                    echo "<td scope='col'>Materia: ".$row['DescMat']."<br>Profesor: ".$row['NomProf']."<br>Hora Inicio: ".$row['HoraInicio']."<br>Hora final: ".$row['HoraFin']."<br>Salon: ".$row['DescSalon']."</td>";
                                }
                            }
                        ?>
                    </tr>
                    <tr>
                        <th scope="col">Martes</th>
                        <?php 
                            while ($row = mysqli_fetch_assoc($datosMartes)) {
                                if($row['Dia']=='Martes'){
                                    echo "<td scope='col'>Materia: ".$row['DescMat']."<br>Profesor: ".$row['NomProf']."<br>Hora Inicio: ".$row['HoraInicio']."<br>Hora final: ".$row['HoraFin']."<br>Salon: ".$row['DescSalon']."</td>";
                                }
                            }
                        ?>
                    </tr>
                    <tr>
                        <th scope="col">Miércoles</th>
                        <?php 
                            while ($row = mysqli_fetch_assoc($datosMiercoles)) {
                                if($row['Dia']=='Miercoles'){
                                    echo "<td scope='col'>Materia: ".$row['DescMat']."<br>Profesor: ".$row['NomProf']."<br>Hora Inicio: ".$row['HoraInicio']."<br>Hora final: ".$row['HoraFin']."<br>Salon: ".$row['DescSalon']."</td>";
                                }
                            }
                        ?>
                    </tr>
                    <tr>
                        <th scope="col">Jueves</th>
                       <?php 
                            while ($row = mysqli_fetch_assoc($datosJueves)) {
                                if($row['Dia']=='Jueves'){
                                    echo "<td scope='col'>Materia: ".$row['DescMat']."<br>Profesor: ".$row['NomProf']."<br>Hora Inicio: ".$row['HoraInicio']."<br>Hora final: ".$row['HoraFin']."<br>Salon: ".$row['DescSalon']."</td>";
                                }
                            }
                        ?>
                    </tr>
                    <tr>
                        <th scope="col">Viernes</th>
                       <?php 
                            while ($row = mysqli_fetch_assoc($datosViernes)) {
                                if($row['Dia']=='Viernes'){
                                    echo "<td scope='col'>Materia: ".$row['DescMat']."<br>Profesor: ".$row['NomProf']."<br>Hora Inicio: ".$row['HoraInicio']."<br>Hora final: ".$row['HoraFin']."<br>Salon: ".$row['DescSalon']."</td>";
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
    <?php }else{
        header("location:cerrarSesion.php");
    } }?>
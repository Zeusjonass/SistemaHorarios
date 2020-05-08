<?php  
    session_start();

    $usuario= $_SESSION['username'];

    $rol=$_SESSION['rol'];

    if(!isset($usuario)){

        header("location:login.php");

    }else{
        
        require 'Dao.php';
        
        if($rol==2){

            $dao=new Dao();

            $datosLunes=$dao->listarDatos('vistaProfesor');

            $datosMartes=$dao->listarDatos('vistaProfesor');

            $datosMiercoles=$dao->listarDatos('vistaProfesor');

            $datosJueves=$dao->listarDatos('vistaProfesor');
            
            $datosViernes=$dao->listarDatos('vistaProfesor');
    ?>
<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <link rel="stylesheet" type="text/css" href="css/">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>Profesor</title>
        <link rel="icon" href="img/uady.png" />
    </head>   
    <body>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <br>
                    <h4 class="d-inline ">Bienvenido profesor <?php echo "$nomProf"; ?></h4>
                    <a href="cerrarSesion.php">
                    <button type="button" class="btn btn-dark btn-sm mb-2 float-right">Cerrar Sesión</button>
                    </a>
                    <br><br><br>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 table-responsive">
                    <table class="table table-dark table-hover table-borderless">
                        <tr>
                            <th scope="col">Lunes</th>
                            <?php while($row=mysqli_fetch_assoc($datosLunes)){ 
                                if($row['Dia']=='Lunes'){
                                    echo "<td scope='col'>Materia: ".$row['DescMat']."<br>Profesor: ".$row['NomProf']."<br>Hora Inicio: ".$row['HoraInicio']."<br>Hora final: ".$row['HoraFin']."<br>Salon: ".$row['DescSalon']."</td>";
                                };
                            }?>
                        </tr>
                        <tr>
                            <th scope="col">Martes</th>
                            <?php while($row=mysqli_fetch_assoc($datosMartes)){ 
                                if($row['Dia']=='Martes'){
                                    echo "<td scope='col'>Materia: ".$row['DescMat']."<br>Profesor: ".$row['NomProf']."<br>Hora Inicio: ".$row['HoraInicio']."<br>Hora final: ".$row['HoraFin']."<br>Salon: ".$row['DescSalon']."</td>";
                                };
                            }?>
                        </tr>
                        <tr>
                            <th scope="col">Miércoles</th>
                            <?php while($row=mysqli_fetch_assoc($datosMiercoles)){ 
                                if($row['Dia']=='Miercoles'){
                                    echo "<td scope='col'>Materia: ".$row['DescMat']."<br>Profesor: ".$row['NomProf']."<br>Hora Inicio: ".$row['HoraInicio']."<br>Hora final: ".$row['HoraFin']."<br>Salon: ".$row['DescSalon']."</td>";
                                };
                            }?>
                        </tr>
                        <tr>
                            <th scope="col">Jueves</th>
                            <?php while($row=mysqli_fetch_assoc($datosJueves)){ 
                                if($row['Dia']=='Jueves'){
                                    echo "<td scope='col'>Materia: ".$row['DescMat']."<br>Profesor: ".$row['NomProf']."<br>Hora Inicio: ".$row['HoraInicio']."<br>Hora final: ".$row['HoraFin']."<br>Salon: ".$row['DescSalon']."</td>";
                                };
                            }?>
                        </tr>
                        <tr>
                            <th scope="col">Viernes</th>
                            <?php while($row=mysqli_fetch_assoc($datosViernes)){ 
                                if($row['Dia']=='Viernes'){
                                    echo "<td scope='col'>Materia: ".$row['DescMat']."<br>Profesor: ".$row['NomProf']."<br>Hora Inicio: ".$row['HoraInicio']."<br>Hora final: ".$row['HoraFin']."<br>Salon: ".$row['DescSalon']."</td>";
                                };
                            }?>
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

        
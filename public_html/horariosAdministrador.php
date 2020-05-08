<?php  
    session_start();
    $cursoObtenido= $_GET['id'];
    $rol=$_SESSION['rol'];

    if(!isset($cursoObtenido)){

        header("location:login.php");

    }else{

        require 'Dao.php';

        if($rol==1){

            $_SESSION['cursoObtenido'] = $cursoObtenido;

            $dao = new Dao();

            $dataCurso= $dao->listarDatos('horariosAdminCurso');

            $idObtenido=mysqli_fetch_assoc($dataCurso);

            $idCurso=$idObtenido['idCurso'];

            $dataLunes = $dao->listarDatos('horariosAdmin');

            $dataMartes = $dao->listarDatos('horariosAdmin');

            $dataMiercoles = $dao->listarDatos('horariosAdmin');

            $dataJueves = $dao->listarDatos('horariosAdmin');

            $dataViernes = $dao->listarDatos('horariosAdmin');
    ?>
<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>horarios</title>
        <link rel="icon" href="img/uady.png"/>
        <script>
            function validarOpcion(opcion){

                form=document.getElementById("form");

                if(opcion=='borrar'){

                    form.action='controlador.php?action=borrar';
                }
                else{

                    form.action='editarClase.php';
                }
            }
        </script>
        <style type="text/css">
            body{
                background: url('img/UADY.jpg') no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                background-size: cover;
                -o-background-size: cover;
                backdrop-filter: blur(10px);
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
        <div class="container-fluid ">
        	<div class="row">
        		<div class="col-12 text-center">
                    <br>
                    <a href="vistaAdministrador.php">
                    <button type="button" class="btn btn-dark btn-sm mb-2 float-left">Regresar</button>
                    </a>
        			<h4 class="titulo d-inline">Información del grupo <?php echo $cursoObtenido;?></h4>
        		</div>
        	</div>
        	<div class="row justify-content-center">
        		<div class="col-6 text-center">
        			<p>Profesor: <?php if ( isset( $idObtenido ) ){ echo $idObtenido['NomProf'];}?></p>
        			<p>Materia: <?php if ( isset( $idObtenido ) ){ echo $idObtenido['DescMat'];}?></p>
        		</div>
        	</div>
            <div class="row justify-content-center">
                <div class="col-12 text-center table-responsive">
                    <form action="" method="POST" id="form">
                    <table class="table table-dark table-hover table-borderless">
                        <tr>
                            <th scope="col">Lunes</th>
                            <?php while( $mostrar = mysqli_fetch_assoc( $dataLunes ) ){ 
                                if( $mostrar['Dia'] == 'Lunes' ){
                                    echo "<td scope='col'>";
                                    echo "<label>";
                                    echo "<input type='radio' value=".$mostrar['idClase']." name='claseElegida' required><br>";
                                    echo "Materia: ".$mostrar['DescMat']."<br>Profesor: ".$mostrar['NomProf']."<br>Hora Inicio: ".$mostrar['HoraInicio']."<br>Hora final: ".$mostrar['HoraFin']."<br>Salon: ".$mostrar['DescSalon'];
                                    echo "</label>";
                                    echo "</td>";
                                    
                                };
                            }?>
                        </tr>
                        <tr>
                            <th scope="col">Martes</th>
                            <?php while( $mostrar2 = mysqli_fetch_assoc( $dataMartes ) ){ 
                                if( $mostrar2['Dia'] == 'Martes' ){
                                	echo "<td scope='col'>";
                                    echo "<label>";
                                    echo "<input type='radio' value=".$mostrar2['idClase']." name='claseElegida' required><br>";
                                    echo "Materia: ".$mostrar2['DescMat']."<br>Profesor: ".$mostrar2['NomProf']."<br>Hora Inicio: ".$mostrar2['HoraInicio']."<br>Hora final: ".$mostrar2['HoraFin']."<br>Salon: ".$mostrar2['DescSalon'];
                                    echo "</label>";
                                    echo "</td>";
                                };
                            }?>
                        </tr>
                        <tr>
                            <th scope="col">Miércoles</th>
                            <?php while( $mostrar3 = mysqli_fetch_assoc( $dataMiercoles ) ){ 
                                if( $mostrar3['Dia'] == 'Miercoles' ){
                                	echo "<td scope='col'>";
                                    echo "<label>";
                                    echo "<input type='radio' value=".$mostrar3['idClase']." name='claseElegida' required><br>";
                                    echo "Materia: ".$mostrar3['DescMat']."<br>Profesor: ".$mostrar3['NomProf']."<br>Hora Inicio: ".$mostrar3['HoraInicio']."<br>Hora final: ".$mostrar3['HoraFin']."<br>Salon: ".$mostrar3['DescSalon'];
                                    echo "</label>";
                                    echo "</td>";
                                };
                            }?>
                        </tr>
                        <tr>
                            <th scope="col">Jueves</th>
                            <?php while( $mostrar4 = mysqli_fetch_assoc( $dataJueves ) ){ 
                                if( $mostrar4['Dia'] == 'Jueves' ){
                            		echo "<td scope='col'>";
                                    echo "<label>";
                                    echo "<input type='radio' value=".$mostrar4['idClase']." name='claseElegida' required><br>";
                                    echo "Materia: ".$mostrar4['DescMat']."<br>Profesor: ".$mostrar4['NomProf']."<br>Hora Inicio: ".$mostrar4['HoraInicio']."<br>Hora final: ".$mostrar4['HoraFin']."<br>Salon: ".$mostrar4['DescSalon'];
                                    echo "</label>";
                                    echo "</td>";
                                };
                            }?>
                        </tr>
                        <tr>
                            <th scope="col">Viernes</th>
                            <?php while( $mostrar5 = mysqli_fetch_assoc( $dataViernes ) ){ 
                                if( $mostrar5['Dia'] == 'Viernes' ){
                                	echo "<td scope='col'>";
                                    echo "<label>";
                                    echo "<input type='radio' value=".$mostrar5['idClase']." name='claseElegida' required><br>";
                                    echo "Materia: ".$mostrar5['DescMat']."<br>Profesor: ".$mostrar5['NomProf']."<br>Hora Inicio: ".$mostrar5['HoraInicio']."<br>Hora final: ".$mostrar5['HoraFin']."<br>Salon: ".$mostrar5['DescSalon'];
                                    echo "</label>";
                                    echo "</td>";
                                };
                            }?>
                        </tr>
                    </table>
                    <button type="input" class="btn btn-danger btn-md" onclick="validarOpcion('borrar')">Borrar</button>
                    <button type="input" class="btn btn-success btn-md" onclick="validarOpcion('editar')">Editar</button><br><br>
                    </form >
                </div>
            </div>
        </div>
    </body>
</html>
    <?php }else{
        header("location:cerrarSesion.php");
    } }?>

        
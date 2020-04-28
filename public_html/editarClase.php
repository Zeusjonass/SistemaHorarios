<?php  
session_start();
$usuario=$_SESSION['username'];
$rol=$_SESSION['rol'];
if(!isset($usuario)):
	header("location:login.php");
else:
	if($rol==1):
		require 'login//conexion.php';
		require 'classes/clase.php';
		$salonesQuery="SELECT * FROM salon";
		$salonResult=mysqli_query($conexion,$salonesQuery);
		if(isset($_POST['claseElegida'])):
			$claseElegida=$_POST['claseElegida'];
			$_SESSION['claseEditar']=$claseElegida;
			$clasesQuery="SELECT * FROM clase where idClase='$claseElegida'";
			$queryResult=mysqli_query($conexion,$clasesQuery);
			$datosObtenidos=mysqli_fetch_array($queryResult);
			$claseAEditar=new Clase($datosObtenidos['idCurso'],$datosObtenidos['idSalon'],$datosObtenidos['Dia'],$datosObtenidos['HoraInicio'],$datosObtenidos['HoraFin']);
		?>
		<html>
		<head>
			<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	        <link rel="stylesheet" type="text/css" href="css/style.css">
	        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	        <link rel="icon" href="img/uady.png"/>
	        <title>Editar clase</title>
	        <style type="text/css">
	        	body{
	                background: url('img/UADY.jpg') no-repeat center center fixed;
	                -webkit-background-size: cover;
	                -moz-background-size: cover;
	                background-size: cover;
	                -o-background-size: cover;
	                backdrop-filter: blur(4px);
            	}
            	.formulario{
	                background-color: rgba(26,53,90,.7);
	                border-radius: 15px;
	                box-shadow: 0px 0px 30px 0px rgba(0,0,0,0.61);
            	}
            	.formulario label p {
            		color: white;
            	}
            	.formulario h2{
            		color: white;
            	}
            </style>
		</head>
		<body>
	        <div class="container-fluid min-vh-100">
		        <div class="row justify-content-center">
		        	<div class="col-12 text-center">
		        		<a href="<?php echo "horariosAdministrador.php?id=".$datosObtenidos['idCurso'] ?>"><input type="button" class="btn btn-dark btn-sm float-left" value="Regresar"></a>
		        	</div>
		        </div>       
	            <div class="form-row h-100 justify-content-center ">
	                <div class="col-4 text-center my-auto">
		                <div class="formulario">
		                	<br>
		                	<h2>Editar horario</h2><br>
		                    <form action="editar.php" method="POST">
								<label><p>Hora inicio:</p>
									<input type="time" name="horaInicio" min="07:00"  max="21:00" required="true" step="1800" value="<?php echo $claseAEditar->getHoraInicio() ?>">
								</label><br>
                				<label><p>Hora Fin: </p><input type="time" name="horaFin" required="true" min="07:00"  max="21:00" step="1800" value="<?php echo $claseAEditar->getHoraFin() ?>"></label><br>
                				<label><p>Día: </p>
				                    <select name="dia" required="true" value="<?php echo $datosObtenidos['Dia']?>">
				                        <option value="Lunes">Lunes</option>
				                        <option value="Martes">Martes</option>
				                        <option value="Miercoles">Miércoles</option>
				                        <option value="Jueves">Jueves</option>
				                        <option value="Viernes">Viernes</option>
				                    </select>
			               	 	</label><br>
				                <label><p>Salón: </p>
				                    <select name="salon" required="true" value="<?php echo $datosObtenidos['idSalon']?>">
				                        <?php while($salones=mysqli_fetch_array($salonResult)){
				                            echo "<option value=".$salones['idSalon'].">".$salones['DescSalon']."</option> ";
				                        } 
				                        ?>
				                    </select>
				                </label><br>
		                        <input type="submit" class="btn btn-dark btn-sm " value="Editar"><br><br>
		                    </form>
		                </div>
	                </div>
	            </div>
            </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		</body>
		</html>		
		<?php
		else:
			echo "No se eligio ninguna clase";
		endif;
	else:
		header("location:cerrarSesion.php");
	endif;
endif;	
?>

<html> 
    <head>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>Sistema de horarios</title>
        <script>
            function errorMessage(){
                alert("Las credenciales no coinciden");
            }
        </script>
    </head>
    <body>
        <div class="modal-dialog text-center">
            <div class="col-sm-8 main-section">
                <div class="modal-content">
                    <div class="col-12 user-img">
                        <img src="img/uady.png">
                    </div>
                    <form class="col-12" action="login/loguear.php" method="POST">
                        <div class="form-group" id="user-group">
                            <input class="form-control-sm" type="text" placeholder="Usuario" id="usuario" name="usuario" required="true">
                        </div>
                        <div class="form-group" id="contrasena-group">
                            <input class="form-control-sm" type="password" placeholder="Ingrese la contraseña" id="password" name="password" required="true">
                        </div>
                        <input type="submit" class="btn btn-dark btn-lg" value="Entrar"><br>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?php 
                if(isset($_GET['error'])){?>
                <script type="text/javascript">
                errorMessage();
                </script>
        <?php } ?>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body> 
</html>

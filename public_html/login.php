
<html> 
    <head>
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <title>Sistema de horarios</title>
        <link rel="icon" href="img/uady.png" />
        <script>
            function errorMessage(){
                alert("El nombre y contraseña no coinciden");
            }
        </script>
        <style>
            body {
                background: url('img/UADY.jpg') no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                background-size: cover;
                -o-background-size: cover;
                background: linear-gradient(180deg, rgba(27, 27, 27, 0) 0%,  100%);
            }
            .formulario{
                background-color: rgba(26,53,90,.7);
                border-radius: 15px;
                box-shadow: 0px 0px 30px 0px rgba(0,0,0,0.61);
            }
            .user-img a img{
                width: 50%;
                height: auto;
                margin-top: -50px;
                margin-bottom: 35px;
                transition: transform .2s;
            }
            .user-img a img:hover{
                cursor: pointer;
                transform: scale(1.2);
            }
            
            input{
               text-align:center;
            }
        </style>
    </head>
    <body>
        <div class="container min-vh-100">        
            <div class="form-row h-100 justify-content-center ">
                <div class="col-4 text-center my-auto">
                <div class="formulario">
                    <div class="user-img">
                        <a href="login.php"><img src="img/uady.png"></a>
                    </div>
                    <form action="login/loguear.php" method="POST">

                        <div class="form-group" id="user-group">
                            <input class="form-control-md" type="text" placeholder="Usuario" id="usuario" name="usuario" required>
                        </div>
                        <div class="form-group" id="contrasena-group">
                            <input class="form-control-md" type="password" placeholder="Contraseña" id="password" name="password" required>
                        </div>
                        <input type="submit" class="btn btn-light btn-sm " value="Entrar"><br><br>
                    </form>
                </div>
                </div>
            </div>
        <?php 
        if(isset($_GET['error'])){
        ?>
        <script type="text/javascript">
        errorMessage();
        </script>
        <?php } ?>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body> 
</html>

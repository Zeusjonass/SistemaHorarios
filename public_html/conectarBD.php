<?php
$mysqli = new mysqli('localhost', 'root','', 'sistemahorario');

if(!$mysqli){
        die($mysqli->connect_error);
    }


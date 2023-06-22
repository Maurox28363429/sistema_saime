<?php
    include('../db/conexion.php');
    $usuario = $_GET['usuario'] ?? '';
    $sql = "SELECT usuario,pregunta_1 FROM `users` WHERE usuario = '$usuario'";
    $result = mysqli_query($conn, $sql);
    $data=[];
    if (mysqli_num_rows($result) > 0) {
        $data[] = mysqli_fetch_assoc($result);
    }else{
        $data[] = array('error' => 'No se encontró el usuario', 'usuario' => $usuario, 'sql' => $sql);
    }
    echo(
        json_encode($data)
    );
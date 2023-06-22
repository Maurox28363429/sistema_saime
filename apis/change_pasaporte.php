<?php
    include('../db/conexion.php');
    $id = $_GET['id'] ?? null;
    $status = $_GET['status'] ?? null;
    if($id && $status){
        $sql = "UPDATE pasaportes SET status = '$status' WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        if($result){
            echo(
                json_encode([
                    'status' => 'success',
                    'id' => $id,
                    'sql' => $sql
                ])
            );
        }else{
            echo(
                json_encode([
                    'status' => 'error',
                    'id' => $id,
                    'sql' => $sql
                ])
            );
        }
    }else{
        echo(
            json_encode([
                'status' => 'error',
                'id' => $id,
                'sql' => $sql
            ])
        );
    }
    
<?php
    include('../db/conexion.php');
    $id = $_GET['id'] ?? null;
    if($id ){
        $sql = "DELETE FROM users WHERE id = '$id'";
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
    
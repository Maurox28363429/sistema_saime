<?php

if (isset($_POST['usuario'])==true && isset($_POST['password'])==true ) {
    $password = md5($_POST['password']);
    $usuario = $_POST['usuario'];
    $sql = "SELECT * FROM users WHERE usuario = '$usuario' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);       
        $_SESSION['user'] = $row;
        // header('Location: /');
    } else {
?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Usuario o contraseña incorrectos',
            })
        </script>
<?php
    }
}
//
if(isset($_GET['usuario'])==true && isset($_GET['respuesta'])==true && isset($_GET['recovery'])==true){
    $usuario = $_GET['usuario'];
    $respuesta = $_GET['respuesta'];
    $sql = "SELECT * FROM users WHERE usuario = '$usuario' AND respuesta_1 = '$respuesta'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user'] = $row;
       header('Location: /');
    } else {
?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Respuesta incorrecta',
            })
        </script>
<?php
    }
}

if(isset($_SESSION['user'])==true){
    
    $sql = "INSERT INTO `log_accesos`(`user_id`, `ip`) VALUES ('".$_SESSION['user']['id']."','". $_SERVER['REMOTE_ADDR']."')";
    $result = mysqli_query($conn, $sql);
    header('Location: /');
}
?>
<style>
    .fondo {
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    body {
        background-image: url('img/page-header.jpg');
        height: 100vh;
        background-size: 100% 100%;
        background-repeat: no-repeat;
    }

    .logo {
        width: 100px;
        height: auto;
        margin: auto
    }
</style>
<section class="fondo">
    <div class="card-panel" style="text-align:center;margin:1em;max-height:500px;padding:1em">
        <img src="img/logo_saime.png" class='logo'>
        <h4>Iniciar Sesión</h4>
        <form action="/" class="row" method="post">
            <div class='col s12 input-field' style="text-align:left;">

                <input type="text" required name="usuario" placeholder="Usuario">
            </div>
            <div class='col s12 input-field' style="text-align:left;">

                <input type="password" required name="password" placeholder="Contraseña">
            </div>
            <div class="col s12" style="text-align:right">
                <a onclick='recovery()' style="margin:0.5em">Olvide mi contraseña</a>
            </div>
            <div class="col s12" style="text-align:center">
                <input type="submit" class="btn blue" style="display:block;width:100%" value="enviar">
            </div>
        </form>
    </div>
</section>
<script>
    function recovery() {
        Swal.fire({
            title: 'Introduzca su nombre de usuario',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Consultar',
            showLoaderOnConfirm: true,
        }).then((text) => {
            if (!text.isConfirmed) return true;
            fetch('/apis/pregunta.php?usuario=' + text.value).then(m => m.json()).then(m => {
                console.log(m);
                if (m[0].error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: m.error,
                    })
                } else {
                    //__________________________
                    Swal.fire({
                        title: m[0].usuario + ',Introduzca su respuesta',
                        text: m[0].pregunta_1,
                        input: 'text',
                        inputAttributes: {
                            autocapitalize: 'off'
                        },
                        showCancelButton: true,
                        confirmButtonText: 'Confirmar',
                        showLoaderOnConfirm: true,
                    }).then(text => {
                        window.location = '?usuario=' + m[0].usuario + '&respuesta=' + text.value + '&recovery=true';
                    });
                    //__________________________
                }
            });
        })
    }
</script>
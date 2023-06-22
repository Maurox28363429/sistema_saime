<?php
if (($_POST['nombres']) == true && ($_POST['apellidos']) == true && ($_POST['usuario']) == true && ($_POST['password']) == true && ($_POST['codigo']) == true && ($_POST['pregunta_1']) == true && ($_POST['respuesta_1']) == true) {
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $usuario = $_POST['usuario'];
    $password = md5($_POST['password']);
    $codigo = $_POST['codigo'];
    $pregunta_1 = $_POST['pregunta_1'];
    $respuesta_1 = $_POST['respuesta_1'];
    $admin = $_POST['admin'];
    $sql = "INSERT INTO users (nombres, apellidos, usuario, password, codigo, pregunta_1, respuesta_1, admin) VALUES ('$nombres', '$apellidos', '$usuario', '$password', '$codigo', '$pregunta_1', '$respuesta_1','$admin')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
?>
        <script>
            swal.fire({
                title: 'Exito',
                text: 'Se registro el Usuario',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                window.location.href = "?router=users";
            })
        </script>
    <?php
    } else {
    ?>
        <script>
            swal.fire({
                title: 'Error',
                text: 'No se pudo registrar el Usuario',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        </script>
<?php
    }
}
?>
<section class="container section">
    <article class="row">
        <div class="col s12">
            <div class="card-panel" style="text-align:left;">
                <a class='waves-effect waves-teal btn-flat' href="?router=users">Volver</a>
                <h5>
                    Registro de Usuario
                </h5>
                <form action="?router=user-add" method="post" class="row">
                    <div class="col s12 m6 l4">
                        <input required type="text" name='nombres' placeholder="Nombres">
                        <label for="">Nombres</label>
                    </div>
                    <div class="col s12 m6 l4">
                        <input required type="text" name='apellidos' placeholder="Apellidos">
                        <label for="">Apellidos</label>
                    </div>
                    <div class="col s12 m6 l4">
                        <input required type="text" name='usuario' placeholder="Usuario">
                        <label for="">Usuario</label>
                    </div>
                    <div class="col s12 m6 l4">
                        <input required type="text" name='password' placeholder="Contraseña" class="tooltipped" data-position="bottom" data-tooltip="
                            <div style='text-align:left !important'>
                            La contraseña es requerida, debe contener:<br>
                            1) Número(s)<br> 
                            2) Letra(s)  <br>
                            3) Al menos una mayúscula <br>
                            4) Un mínimo de 8 y un maximo de 16 caracteres <br>
                            Ejemplo: 12Abcd34 <br>
                            </div>
                        ">
                        <label for="">Contraseña</label>
                    </div>
                    <div class="col s12 m6 l4">
                        <input required type="text" name='codigo' placeholder="Codigo">
                        <label for="">Codigo</label>
                    </div>
                    <div class="col s12 m6 l4">
                        <input required type="text" name='nombres' placeholder="Nombres">
                        <label for="">Nombres</label>
                    </div>
                    <div class="col s12 m6 l4">
                        <input required type="text" name='pregunta_1' placeholder="Pregunta de seguridad">
                        <label for="">Pregunta de seguridad</label>
                    </div>
                    <div class="col s12 m6 l4">
                        <input required type="text" name='respuesta_1' placeholder="Respuesta de la pregunta">
                        <label for="">Resupuesta personalizada</label>
                    </div>
                    <div class="col s12 m6 l4">
                        <select name="admin" class="select">
                            <option value="0">Usuario común</option>
                            <option value="1">Administrador</option>
                        </select>
                    </div>
                    <div class="col s12" style='padding:1em'>
                        <input type="submit" style="display:block;width:100%" class='btn green' value='Enviar'>
                    </div>
                </form>
            </div>
        </div>
    </article>
</section>

<script>
    $(document).ready(function() {
        $('.tooltipped').tooltip({
            html: "true"
        });
    });
    $(document).ready(function() {
        $('.select').formSelect();
    });
</script>
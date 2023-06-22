<?php
if (isset($_GET['id']) == true) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
}
if (isset($_POST['nombres']) == true && isset($_POST['apellidos']) == true && isset($_POST['usuario']) == true && isset($_POST['codigo']) == true && isset($_POST['pregunta_1']) == true && isset($_POST['respuesta_1']) == true) {
    $id = $_POST['id'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $usuario = $_POST['usuario'];
    if ($_POST['password'] != "") {
        $password = md5($_POST['password']);
    }
    $admin = $_POST['admin'];
    $codigo = $_POST['codigo'];
    $pregunta_1 = $_POST['pregunta_1'];
    $respuesta_1 = $_POST['respuesta_1'];
    $sql = "UPDATE users SET nombres = '$nombres', apellidos = '$apellidos', usuario = '$usuario', codigo = '$codigo', pregunta_1 = '$pregunta_1', respuesta_1 = '$respuesta_1'";
    if ($_POST['password']) {
        $sql .= ", password = '$password'";
    }
    $sql .= " WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
?>
        <script>
            swal.fire({
                title: 'Exito',
                text: 'Se actualizo el Usuario',
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
                text: 'No se pudo actualizar el Usuario',
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
                    Editar Usuario
                </h5>
                <form action="?router=user-edit" method="post" class="row">
                    <div class="col s12 m6 l4">
                        <input required type="text" name='nombres' value='<?php echo ($user['nombres']); ?>' placeholder="Nombres">
                        <label for="">Nombres</label>
                    </div>
                    <div class="col s12 m6 l4">
                        <input required type="text" name='apellidos' value='<?php echo ($user['apellidos']); ?>' placeholder="Apellidos">
                        <label for="">Apellidos</label>
                    </div>
                    <div class="col s12 m6 l4">
                        <input required type="text" name='usuario' value='<?php echo ($user['usuario']); ?>' placeholder="Usuario">
                        <label for="">Usuario</label>
                    </div>
                    <div class="col s12 m6 l4">
                        <input type="text" name='password' placeholder="Contraseña (Dejar vacia o se cambiara)">
                        <label for="">Contraseña</label>
                    </div>
                    <div class="col s12 m6 l4">
                        <input required type="text" name='codigo' value='<?php echo ($user['codigo']); ?>' placeholder="Codigo">
                        <label for="">Codigo</label>
                    </div>
                    <div class="col s12 m6 l4">
                        <input required type="text" name='pregunta_1' value='<?php echo ($user['pregunta_1']); ?>' placeholder="Pregunta de seguridad">
                        <label for="">Pregunta de seguridad</label>
                    </div>
                    <div class="col s12 m6 l4">
                        <input required type="text" name='respuesta_1' value='<?php echo ($user['respuesta_1']); ?>' placeholder="Respuesta personalizada">
                        <label for="">Resupuesta personalizada</label>
                    </div>
                    <div class="col s12 m6 l4">
                        <select name="admin" class="select">

                            <option value="0" <?php if ($user['admin'] == 0) {
                                                    echo ("selected");
                                                } ?>>Usuario</option>

                            <option value="1" <?php if ($user['admin'] == 1) {
                                                    echo ("selected");
                                                } ?>>Administrador</option>

                        </select>
                    </div>
                    <div class="col s12" style='padding:1em'>
                        <input type="hidden" value='<?php echo ($user['id']); ?>' name='id'>
                        <input type="submit" style="display:block;width:100%" class='btn green' value='Enviar'>
                    </div>
                </form>
            </div>
        </div>
    </article>
</section>
<script>
    $(document).ready(function() {
        $('.select').formSelect();
    });
</script>
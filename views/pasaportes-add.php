<?php
if (isset($_POST['cedula'])==true) {
    $cedula = $_POST['cedula'];
    $nombres = $_POST['nombres'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $num_pasaporte = $_POST['num_pasaporte'];
    $fecha_emision = $_POST['fecha_emision'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];
    $sexo = $_POST['sexo'];
    $sql = "INSERT INTO pasaportes (cedula,nombres,fecha_nacimiento,num_pasaporte,sexo,fecha_emision,fecha_vencimiento) VALUES ('$cedula','$nombres','$fecha_nacimiento','$num_pasaporte','$sexo','$fecha_emision','$fecha_vencimiento')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
?>
        <script>
            swal.fire({
                title: 'Exito',
                text: 'Se registro el pasaporte',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
        </script>
    <?php
    } else {
    ?>
        <script>
            swal.fire({
                title: 'Error',
                text: 'No se pudo registrar el pasaporte',
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
                <a class='waves-effect waves-teal btn-flat' href="?router=pasaportes">Volver</a>
                <h5>
                    Registro de pasaporte
                </h5>
                <form action="?router=pasaportes-add" method="post" class="row">
                    <div class="col s12 m6 l4">
                        <input required type="text" name='cedula' placeholder="Cedula">
                        <label for="">Cedula</label>
                    </div>
                    <div class="col s12 m6 l4">
                        <input required type="text" name='nombres' placeholder="Nombre">
                        <label for="">Nombre</label>
                    </div>
                    <div class="col s12 m6 l4">
                        <input required type="date" name='fecha_nacimiento' placeholder="Fecha de nacimiento">
                        <label for="">Fecha de nacimiento</label>
                    </div>

                    <div class="col s12 m6 l4">
                        <input required type="number" name='num_pasaporte' placeholder="Numero de pasaporte">
                        <label for="">Numero de pasaporte</label>
                    </div>
                    <div class="col s12 m6 l4">
                        <select name="sexo" class="select">
                            <option>Masculino Mayor de Edad</option>
                            <option>Femenino Mayor de Edad</option>
                            <option>Masculino Menor de Edad</option>
                            <option>Femenino Menor de Edad</option>
                        </select>
                    </div>
                    <div class="col s12 m6 l4">
                        <input required type="date" name='fecha_emision' placeholder="Fecha de emision">
                        <label for="">Fecha de emision</label>
                    </div>
                    <div class="col s12 m6 l4">
                        <input required type="date" name='fecha_vencimiento' placeholder="Fecha de vencimiento">
                        <label for="">Fecha de vencimiento</label>
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
        $('.select').formSelect();
    });
</script>
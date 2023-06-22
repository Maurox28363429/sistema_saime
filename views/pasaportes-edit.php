<?php
if (isset($_GET['id'])==true) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM pasaportes WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $pasaporte = mysqli_fetch_assoc($result);
}
if (isset($_POST['id'])==true) {
    $id = $_POST['id'];
    $cedula = $_POST['cedula'];
    $nombres = $_POST['nombres'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $num_pasaporte = $_POST['num_pasaporte'];
    $fecha_emision = $_POST['fecha_emision'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];
    $sexo = $_POST['sexo'];
    $sql = "UPDATE pasaportes SET cedula = '$cedula', nombres = '$nombres', fecha_nacimiento = '$fecha_nacimiento', num_pasaporte = '$num_pasaporte',sexo = '$sexo', fecha_emision = '$fecha_emision', fecha_vencimiento = '$fecha_vencimiento' WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
?>
        <script>
            swal.fire({
                title: 'Exito',
                text: 'Se actualizo el pasaporte',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            }).then(m => {
                window.location = '?router=pasaportes';
            });
        </script>
    <?php
    } else {
    ?>
        <script>
            swal.fire({
                title: 'Error',
                text: 'No se pudo actualizar el pasaporte',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        </script>
<?php
    }
}

$sexos = [
    "Masculino Mayor de Edad",
    "Femenino Mayor de Edad",
    "Masculino Menor de Edad",
    "Femenino Menor de Edad"
];
?>
<section class="container section">
    <article class="row">
        <div class="col s12">
            <div class="card-panel" style="text-align:left;">
                <a class='waves-effect waves-teal btn-flat' href="?router=pasaportes">Volver</a>
                <h5>
                    Registro de pasaporte
                </h5>
                <form action="?router=pasaportes-edit" method="post" class="row">
                    <div class="col s12 m6 l4">
                        <input required type="text" name='cedula' value='<?php echo ($pasaporte['cedula']); ?>' placeholder="Cedula">
                        <label for="">Cedula</label>
                    </div>
                    <div class="col s12 m6 l4">
                        <input required type="text" name='nombres' value='<?php echo ($pasaporte['nombres']); ?>' placeholder="Nombre">
                        <label for="">Nombre</label>
                    </div>
                    <div class="col s12 m6 l4">
                        <input required type="date" name='fecha_nacimiento' value='<?php echo ($pasaporte['fecha_nacimiento']); ?>' placeholder="Fecha de nacimiento">
                        <label for="">Fecha de nacimiento</label>
                    </div>

                    <div class="col s12 m6 l4">
                        <input required type="number" name='num_pasaporte' value='<?php echo ($pasaporte['num_pasaporte']); ?>' placeholder="Numero de pasaporte">
                        <label for="">Numero de pasaporte</label>
                    </div>
                    <div class="col s12 m6 l4">
                        <select name="sexo" class="select">
                            <?php
                            foreach ($sexos as $sexo) {
                                $selected = $sexo == $pasaporte['sexo'] ? 'selected' : '';
                                echo "<option $selected>$sexo</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col s12 m6 l4">
                        <input required type="date" name='fecha_emision' value='<?php echo ($pasaporte['fecha_emision']); ?>' placeholder="Fecha de emision">
                        <label for="">Fecha de emision</label>
                    </div>
                    <div class="col s12 m6 l4">
                        <input required type="date" name='fecha_vencimiento' value='<?php echo ($pasaporte['fecha_vencimiento']); ?>' placeholder="Fecha de vencimiento">
                        <label for="">Fecha de vencimiento</label>
                    </div>
                    <div class="col s12" style='padding:1em'>
                        <input type="hidden" name='id' value='<?php echo ($pasaporte['id']); ?>'>
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
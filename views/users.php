<?php
include('db/conexion.php');
$page = (isset($_GET['page']))? $_GET['page']:0;
$offset = $page * 30;
if ($_GET['search'] || $_GET['tipo'] || $_GET['desde'] || $_GET['hasta']) {
    $search = $_GET['search'] ?? '';
    $tipo = $_GET['tipo'] ?? '';
    $desde = $_GET['desde'] ?? '';
    $hasta = $_GET['hasta'] ?? '';
    $sql = "SELECT * FROM users WHERE 1=1 ";
    if ($search != '') {
        //$sql .= " AND (cedula LIKE '%$search%' OR nombres LIKE '%$search%' OR num_pasaporte LIKE '%$search%')";
        $sql .= " AND (nombres LIKE '%$search%' OR apellidos LIKE '%$search%' OR usuario LIKE '%$search%' OR codigo LIKE '%$search%')";
    }
    if ($desde && $hasta) {
        $sql .= " AND created_at BETWEEN '$desde' AND '$hasta'";
    }
    $sql .= " limit 30 offset $offset";
} else {
    $sql = "SELECT * FROM users limit 30 offset $offset";
}
$result = mysqli_query($conn, $sql);

$count_sql = "SELECT count(*) as total FROM users";
$count_result = mysqli_query($conn, $count_sql);
$count = mysqli_fetch_assoc($count_result);
$count = $count['total'];
?>
<section class=" section">
    <article class="row">
        <div class="col s12">
            <div class="card-panel" style="text-align:center;">
                <section class="row">
                    <div class="col s6" style="text-align:left;">
                        <h5>
                            Buscar por coincidencia
                            <a class='btn blue' onclick='buscar()'>Buscar</a>
                        </h5>
                        <div class="input-field">
                            <input placeholder="Buscar" type="text" id='search'>
                        </div>
                    </div>
                    <div class="col s6" style="text-align:left;">
                        <h5>
                            Buscar por rango de fecha
                            <a class='btn blue' onclick='buscar()'>Buscar</a>
                        </h5>
                        <div class="input-field">
                            <input type="text" class="datepicker" placeholder="Desde" id='desde'>
                        </div>
                        <div class="input-field">
                            <input type="text" class="datepicker" placeholder="Hasta" id='hasta'>
                        </div>
                    </div>
                </section>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Accesos</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Usuario</th>
                            <th>codigo</th>
                            <th>Creado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr>
                                <td>
                                    <?php echo ($row['id']); ?>
                                </td>
                                <td>
                                    <?php
                                        $sql_logs = "SELECT count(*) as total FROM log_accesos WHERE user_id = ".$row['id'];
                                        $result_logs = mysqli_query($conn, $sql_logs);
                                        $count_logs = mysqli_fetch_assoc($result_logs);
                                        echo ($count_logs['total']);
                                    ?>
                                </td>
                                <td>
                                    <?php echo ($row['nombres']); ?>
                                </td>
                                <td>
                                    <?php echo ($row['apellidos']); ?>
                                </td>
                                <td>
                                    <?php echo ($row['usuario']); ?>
                                </td>
                                <td>
                                    <?php echo ($row['codigo']); ?>
                                </td>
                                <td>
                                    <?php
                                    $date = date('d-m-y', strtotime($row['created_at']));
                                    echo ($date);
                                    ?>
                                </td>
                                <td>
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-trigger btn' href='#' data-target='dropdown<?php echo ($row['id']); ?>' style="width:200px;">
                                        Opciones
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='dropdown<?php echo ($row['id']); ?>' class='dropdown-content'>
                                        <li><a href="?router=user-edit&id=<?php echo ($row['id']); ?>">Editar</a></li>
                                        <li><a href="#" onclick="borrar(<?php echo ($row['id']); ?>);">Eliminar</a></li>
                                    </ul>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div>
                    <div>
                        <h5 style="text-align:left;padding:0.5em 0">
                            Total de registros: <?php echo ($count); ?>
                        </h5>
                        <h5 style="text-align:left;padding:0.5em 0">
                            Pagina: <?php echo ($page + 1); ?> de <?php echo (ceil($count / 30)); ?>
                        </h5>
                    </div>
                    <ul class="pagination">
                        <?php
                        if ($page > 0) :
                        ?>
                            <li class="waves-effect">
                                <a onclick="pagination(<?php echo ($page - 1); ?>)">Anterior</a>
                            </li>
                        <?php endif; ?>
                        <?php
                        $pages = ceil($count / 30);
                        for ($i = 0; $i < $pages; $i++) :
                        ?>
                            <li class="waves-effect <?php
                                if ($page == $i) echo ('active');
                            ?>">
                                <a onclick="pagination(<?php echo ($i); ?>)"><?php echo ($i + 1); ?></a>
                            </li>
                        <?php endfor; ?>
                        <?php
                        if ($page < $pages - 1) :
                        ?>
                            <li class="waves-effect">
                                <a onclick="pagination(<?php echo ($page + 1); ?>)">Siguiente</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </article>
</section>

<div class="fixed-action-btn">
    <a class="btn-floating btn-large green" href="?router=user-add">
        +
    </a>
    <!--     <ul>
        <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a></li>
        <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>
        <li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>
        <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>
    </ul> -->
</div>

<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('.dropdown-trigger').dropdown();
        $('select').formSelect();
    });

    function buscar() {
        let search = $('#search').val();
        let tipo = $('#tipo').val();
        let desde = $('#desde').val();
        let hasta = $('#hasta').val();
        window.location = '?router=users&page=<?php echo ($page); ?>&search=' + search + '&tipo=' + tipo + '&desde=' + desde + '&hasta=' + hasta;
    }

    function pagination(page) {
        let search = $('#search').val();
        let tipo = $('#tipo').val();
        let desde = $('#desde').val();
        let hasta = $('#hasta').val();
        window.location = '?router=users&page=' + page + '&search=' + search + '&tipo=' + tipo + '&desde=' + desde + '&hasta=' + hasta;
    }
    async function borrar(id) {
        Swal.fire({
            title: 'Desea borrar este registro?',
            text: "Si borra este registro no podra recuperarlo!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Borrar'
        }).then(async (result) => {
            if (result.isConfirmed) {
                await fetch('/apis/user_borrar.php?id=' + id, {
                        method: 'GET',
                    })
                    .then(m => m.json())
                    .then(r => {
                        window.location.reload();
                    });
            }
        })
    }
</script>
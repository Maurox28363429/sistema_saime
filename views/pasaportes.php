<?php
include('db/conexion.php');
$page = (isset($_GET['page'])==true)? $_GET['page'] : 0;
$offset = $page * 30;
if (isset($_GET['search'])==true || isset($_GET['tipo'])==true || isset($_GET['desde'])==true || isset($_GET['hasta'])==true) {
    $search = $_GET['search'] ?? '';
    $tipo = $_GET['tipo'] ?? '';
    $desde = $_GET['desde'] ?? '';
    $hasta = $_GET['hasta'] ?? '';
    $sql = "SELECT * FROM pasaportes WHERE 1=1 ";
    if ($search != '') {
        $sql .= " AND (cedula LIKE '%$search%' OR nombres LIKE '%$search%' OR num_pasaporte LIKE '%$search%')";
    }
    if ($tipo == 2) {
        $sql .= " AND status = 1";
    } else if ($tipo == 3) {
        $sql .= " AND status = 2";
    }
    else if ($tipo == 4) {
        $sql .= " AND status = 3";
    }
    if ($desde && $hasta) {
        $sql .= " AND fecha_emision BETWEEN '$desde' AND '$hasta'";
    }
    $sql .= " limit 30 offset $offset";
} else {
    $sql = "SELECT * FROM pasaportes limit 30 offset $offset";
}
$result = mysqli_query($conn, $sql);

$count_sql = "SELECT COUNT(*) as total FROM pasaportes where 1=1";
if ($search != '') {
    $count_sql .= " AND (cedula LIKE '%$search%' OR nombres LIKE '%$search%' OR num_pasaporte LIKE '%$search%')";
}
if ($tipo == 2) {
    $count_sql .= " AND status = 1";
} else if ($tipo == 3) {
    $count_sql .= " AND status = 2";
}
else if ($tipo == 4) {
    $count_sql .= " AND status = 3";
}
if ($desde && $hasta) {
    $count_sql .= " AND fecha_emision BETWEEN '$desde' AND '$hasta'";
}

$count_result = mysqli_query($conn, $count_sql);
$count_row = $count_result->fetch_assoc();
$count = $count_row['total'];
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
                        <div class="input-field">
                            <select id='tipo'>
                                <option value="1">Todos</option>
                                <option value="2">Incorporados</option>
                                <option value="3">Desincorporados</option>
                                <option value="4">Entregados</option>
                            </select>
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
                            <th>Cedula</th>
                            <th>Nombres</th>
                            <th>Fecha de nacimiento</th>
                            <th>Num pasaporte</th>
                            <th>Sexo y grupo</th>
                            <th>Fecha de emisión</th>
                            <th>Fecha de vencimiento</th>
                            <th>Status</th>
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
                                    <?php echo ($row['cedula']); ?>
                                </td>
                                <td>
                                    <?php echo ($row['nombres']); ?>
                                </td>
                                <td>
                                    <?php
                                    $dateObj = DateTime::createFromFormat('Y-m-d', $row['fecha_nacimiento']);
                                    $convertedDate = $dateObj->format('d/m/Y');
                                    echo ($convertedDate);
                                    ?>
                                </td>
                                <td>
                                    <?php echo ($row['num_pasaporte']); ?>
                                </td>
                                <td>
                                    <?php echo ($row['sexo']); ?>
                                </td>
                                <td>
                                    <?php
                                    $dateObj = DateTime::createFromFormat('Y-m-d', $row['fecha_emision']);
                                    $convertedDate = $dateObj->format('d/m/Y');
                                    echo ($convertedDate);
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo ($row['fecha_vencimiento']);
                                    // Get the current date and time
                                    $now = new DateTime();
                                    // Create a new date object from a string
                                    $date = new DateTime($row['fecha_vencimiento']);
                                    // Compare the dates
                                    if ($date < $now) {
                                    ?>
                                        <div class="chip red" style="color:white !important">
                                            Vencida
                                        </div>
                                    <?php
                                    } else if ($date == $now) {
                                    ?>
                                        <div class="chip yellow" style="color:white !important">
                                            Se vence hoy
                                        </div>
                                    <?php
                                    } else { ?>
                                        <div class="chip green" style="color:white !important">
                                            Vigente
                                        </div>
                                    <?php }
                                    ?>
                                </td>
                                <td>
                                    <?php if ($row['status'] == 1) : ?>
                                        <div class="chip gray black-text" style="color:black !important">
                                            Incorporado
                                        </div>
                                    <?php elseif ($row['status'] == 3): ?>
                                        <div class="chip green" style="color:white !important">
                                            Entregado
                                        </div>
                                    <?php else : ?>
                                        <div class="chip red" style="color:white !important">
                                            Desincorporado
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <!-- Dropdown Trigger -->
                                    <a class='dropdown-trigger btn' href='#' data-target='dropdown<?php echo ($row['id']); ?>' style="width:200px;">
                                        Opciones
                                    </a>

                                    <!-- Dropdown Structure -->
                                    <ul id='dropdown<?php echo ($row['id']); ?>' class='dropdown-content'>
                                        <?php if ($row['status']!=3): ?>
                                            <li>
                                                <a onclick="change(<?php echo ($row['id']); ?>,3)">Entregar</a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if ($row['status'] == 1) : ?>
                                            <li>
                                                <a onclick="change(<?php echo ($row['id']); ?>,2">Desincorporar</a>
                                            </li>
                                        <?php else : ?>
                                            <li>
                                                <a onclick="change(<?php echo ($row['id']); ?>,1)">Incorporar</a>
                                            </li>
                                        <?php endif; ?>
                                        <li><a href="?router=pasaportes-edit&id=<?php echo ($row['id']); ?>">Editar</a></li>
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
                            <br>
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
                                if($page == $i) echo('active');
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
                <section class='row' style="margin:1em">
                    <div class="col s12" style="text-align:left">
                        <a href="?router=imprimir_desin&status=2" class='btn' target="_blank">Imprimir Desincorporados</a>
                        <a href="?router=imprimir_desin&status=1" class='btn' target="_blank">Imprimir Incorporados</a>
                        <a href="?router=imprimir_desin&status=3" class='btn' target="_blank">Imprimir Entregados</a>
                    </div>
                </section>
            </div>
        </div>
    </article>
</section>

<div class="fixed-action-btn">
    <a class="btn-floating btn-large green" href="?router=pasaportes-add">
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

    async function change(id, status) {
        
        await fetch('/apis/change_pasaporte.php?id=' + id + '&status=' + status, {
                method: 'GET',
            })
            .then(m => m.json())
            .then(r => {
                window.location.reload();
            });
    }

    function buscar() {
        let search = $('#search').val();
        let tipo = $('#tipo').val();
        let desde = $('#desde').val();
        let hasta = $('#hasta').val();
        window.location = '?router=pasaportes&page=<?php echo ($page); ?>&search=' + search + '&tipo=' + tipo + '&desde=' + desde + '&hasta=' + hasta;
    }

    function pagination(page) {
        let search = $('#search').val();
        let tipo = $('#tipo').val();
        let desde = $('#desde').val();
        let hasta = $('#hasta').val();
        window.location = '?router=pasaportes&page=' + page + '&search=' + search + '&tipo=' + tipo + '&desde=' + desde + '&hasta=' + hasta;
    }
    async function borrar(id) {
        Swal.fire({
            title: 'Desea borrar este registro?',
            text: "Si borrar este registro no podra recuperarlo!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Borrar',
            cancelButtonText: 'Cancelar'
        }).then(async (result) => {
            if (result.isConfirmed) {
                await fetch('/apis/pasaporte_borrar.php?id=' + id, {
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
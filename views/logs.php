<?php
    include('db/conexion.php');
    $page = (isset($_GET['page'])) ? $_GET['page'] : 0;
    $offset = $page * 30;
    $search = (isset($_GET['search'])) ? $_GET['search'] : null;
    $sql="SELECT * FROM log_accesos INNER JOIN users ON log_accesos.user_id = users.id ";
    $sql.="WHERE 1=1 ";
    if($search!=null){
        $sql.="AND (nombres LIKE '%$search%' OR apellidos LIKE '%$search%' OR usuario LIKE '%$search%' OR codigo LIKE '%$search%') ";
    }
    $sql.="limit 30 offset $offset";
    $result = mysqli_query($conn, $sql);
    $count_sql = "SELECT count(*) as total FROM log_accesos INNER JOIN users ON log_accesos.user_id = users.id ";
    $count_sql.="WHERE 1=1 ";
    if($search!=null){
        $count_sql.="AND (nombres LIKE '%$search%' OR apellidos LIKE '%$search%' OR usuario LIKE '%$search%' OR codigo LIKE '%$search%') ";
    }
    $count_result = mysqli_query($conn, $count_sql);
    $count = mysqli_fetch_assoc($count_result);
    $count = $count['total'];
?>
<section class="container section>
    <div class='row'>
        <article class='col s12' style='padding:1em'>
            <div class='card-panel' style='padding:1em'>
                <div class="input-field" style="margin-top:2em;" align='center'>
                    <input placeholder="Buscar" type="text" id='search' style="width:70%;">
                    <a class='btn blue' onclick='pagination(0)'>Buscar</a>
                </div>
                <table style='width:100%'>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>IP Equipo</th>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php
                                    $ip = $row['ip'];
                                    if($ip=='::1'){
                                        $ip = 'localhost';
                                    }else{
                                        $ip = gethostbyaddr($ip);
                                    }
                                    echo $ip;
                                ?></td>
                                <td><?php echo $row['nombres'] . " " . $row['apellidos']; ?></td>
                                <td><?php echo $row['usuario']; ?></td>
                                <td><?php 
                                    $date = new DateTime($row['created_at']);
                                    echo $date->format('d/m/Y H:i:s');
                                ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div style='padding:1em;text-align:center'>
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
        </article>
    </div>
</section>
<script>
    function pagination(page) {
        let search = $('#search').val();
        window.location = "?router=logs&page=" + page + "&search=" + search;
    }
</script>
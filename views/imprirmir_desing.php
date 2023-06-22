<?php
 include('db/conexion.php');
    
    $status= (isset($_GET['status']))? $_GET['status']:2;
    $sql = "SELECT * FROM pasaportes where status = '$status'";
    $pasaportes = mysqli_query($conn, $sql);

    //contar
    $count_sql = "SELECT COUNT(*) as total FROM pasaportes where status = '$status'";
    $count_result = mysqli_query($conn, $count_sql);
    $count_row = $count_result->fetch_assoc();
    $total = $count_row['total'];
    
?>
<section class='container section'>
    <article class="row">
        <div class="col s8">
            <h5>
                REPORTE DE PASAPORTES ENVIADOS A LA OFICINA
            </h5>
            <table style="width:100%;">
                <tbody>
                    <tr>
                        <td>PAIS:</td>
                        <td>Venezuela</td>
                    </tr>
                    <tr>
                        <td>OFICINA:</td>
                        <td>Mercado Turístico OF079</td>
                    </tr>
                    <tr>
                        <td>FECHA DE IMPRESIÓN</td>
                        <td><?php 
                            date_default_timezone_set('America/Caracas');
                            echo date('d-m-Y H:i:s');
                        ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col s4" style="text-align:center;">
            <img src="img\logo_saime.png" style="width:100%;height:auto">
        </div>
    </article>
    <article class="row">
        <div class="col s12" style="margin-bottom:4em;">
            <table style="width:100%;margin-bottom:2em">
                <thead class="blue white-text">
                    <tr>
                        <th>Cedula</th>
                        <th>Nombre Completo</th>
                        <th>Numero de pasaporte</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($pasaporte = mysqli_fetch_array($pasaportes)) {
                        ?>
                            <tr>
                                <td><?php echo $pasaporte['cedula']; ?></td>
                                <td><?php echo $pasaporte['nombres']; ?></td>
                                <td><?php echo $pasaporte['num_pasaporte']; ?></td>
                            </tr>
                        <?php
                        }
                    ?>
                </tbody>
            </table>
        <div style="padding:2em;text-align:justify;">
            Así mismo deja constancia en este acto de que cualquier anormalidad en el manejo de los documentos será sancionado(a) de acuerdo a lo establecido en los artículos 327 ordinales 1, 2 y 3 en el artículo 328 del código penal vigente. Se leyó y conforme firman.
        </div>
            <div style="text-align:right;">
                <h5>Total de pasaportes: <?php echo $total; ?></h5>
            </div>
        </div>
        <div class="col s4">
            <hr>
            <p style="text-align:center;">Operador Auxiliar</p>
        </div>
        <div class="col s4">
            <hr>
            <p style="text-align:center;">Recibe Conforme</p>
        </div>
        <div class="col s4">
            <hr>
            <p style="text-align:center;">Jefe de Turno</p>
        </div>
    </article>
</section>
<script>
    window.print();
</script>
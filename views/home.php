<article class="fondo">
    <section class="container section">
        <article class="row">
            <div class="col s12">
                <div class="card-panel" style="text-align:center;">
                    <h3 class="text-center"><strong>¡Bienvenido! </strong></h3>
                    <h4 class="text-center">Funcionario: <?php echo $_SESSION['user']['nombres'];
                                                            echo $_SESSION['user']['apellidos'] ?></h4>
                    <p class="lead text-center"> Sistema de Gestión de Bóveda SAIME</p>
                    <p class="lead text-center"> Oficina: OF079 Mercado Turístico</p>
                    <hr class="my-4">
                    <div style="text-align:justify;">
                        <h4 class="text-center"><strong>¡INFORMACIÓN IMPORTANTE! </strong></h4>
                        <p> Acaba de Ingresar con credenciales de un usuario identificado en un Sistema de caracter confidencial, tenga en cuenta que está accediendo a datos e información de interés de Seguridad de Estado, lo cual su manipulación inescrupulosa representa responsabilidades penales y administrativas. Las operaciones sobre éste sistema, están siendo monitoreadas y registradas. Si usted no es el titular del usuario, le recomendamos Cerrar Sesión, Por favor evite ser sancionado.</p>
                    </div>
                    <a class="btn green btn-sm" href="?router=home" role="button">Iniciar Operaciones</a>

                    <a class="btn red btn-small" href="?router=salir">Cerrar Sesión</a>
                </div>
            </div>
        </article>
    </section>
</article>
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
</style>
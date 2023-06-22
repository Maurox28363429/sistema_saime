  <nav class='primary-color'>
      <div class="nav-wrapper">
          <a href="#" class="brand-logo">
              <img src="img/saime.png" alt="" style="margin-left:1em;width:48px;height:48px;margin-top:5px">
          </a>
          <ul class="right">
              <li>
                  <a onclick="$('.sidenav').sidenav('open')">
                      <img src="img/outline_menu_white_24dp.png" style="padding-top:0.5em;">
                  </a>
              </li>
          </ul>
      </div>
  </nav>
  <ul id="slide-out" class="sidenav">
      <li>
          <div class="user-view">
              <div class="background">
                  <img src="img/page-header.jpg">
              </div>
              <a href="#user"><img class="circle" src="img/icon-256x256.png"></a>
              <a href="#name"><span class="white-text name">
                      <?php echo $_SESSION['user']['usuario']; ?>
                  </span></a>
              <a href="#email"><span class="white-text email">
                      <?php echo $_SESSION['user']['nombres'] . ' ' . $_SESSION['user']['apellidos']; ?>
                  </span></a>
          </div>
      </li>

      <?php if ($_SESSION['user']['admin'] == 1) { ?>
          <li><a href="?router=users">Administrar Usuarios</a></li>
          <li><a href="?router=logs">Logs de accesos</a></li>

      <?php } ?>
      <li><a href="?router=pasaportes">Administrar pasaportes</a></li>
      <li>
          <div class="divider"></div>
      </li>
      <li><a href="?router=salir">Cerrar sesión</a></li>
  </ul>
  <script>
      $(document).ready(function() {
          $('.sidenav').sidenav();
      });
  </script>
<div class="content-wrapper">
  <?php require('./components/menu_admin_local.php');?>
  <div class="content-header">
    <?php
    if (isset($_GET['pages'])) {
      switch ($_GET['pages']) {
        case 'home':
          require('./pages/admin_local/home.php');
          break;
          case 'ajouter_clients':
          require('./pages/admin_local/add.php');
            break;
            case 'adjouter_espaces':
            require('./pages/admin_local/add.php');
              break;
              case 'add':
              require('./pages/admin_local/add.php');
                break;
              case 'profile':
              require('./pages/admin_local/add.php');
                break;
              case 'view':
              require('./pages/admin_local/view.php');
                break;
          default:
            echo "Page not found !";
            break;
        }
      }
    ?>
  </div>
  </div>
  <?php require('components/footer.php');?>

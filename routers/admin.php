<div class="content-wrapper">
  <?php require('./components/menu_admin.php');?>
  <div class="content-header">
    <?php
    if (isset($_GET['pages'])) {
      switch ($_GET['pages']) {
        case 'home':
          require('./pages/admin/home.php');
          break;
          case 'ajouter_clients':
          require('./pages/admin/add.php');
            break;
            case 'adjouter_espaces':
            require('./pages/admin/add.php');
              break;
              case 'add':
              require('./pages/admin/add.php');
                break;
              case 'profile':
              require('./pages/admin/add.php');
                break;
              case 'view':
              require('./pages/admin/view.php');
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

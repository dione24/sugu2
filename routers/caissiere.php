<div class="content-wrapper">
  <?php require('./components/menu_caissiere.php');?>
  <div class="content-header">
    <?php
    if (isset($_GET['pages'])) {
      switch ($_GET['pages']) {
        case 'home':
          require('./pages/caissiere/home.php');
          break;
          case 'ajouter_clients':
          require('./pages/caissiere/add.php');
            break;
            case 'adjouter_espaces':
            require('./pages/caissiere/add.php');
              break;
              case 'add':
              require('./pages/caissiere/add.php');
                break;
              case 'profile':
              require('./pages/caissiere/add.php');
                break;
              case 'view':
              require('./pages/caissiere/view.php');
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

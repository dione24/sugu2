<div class="content-wrapper">
  <?php require('./components/menu_gerant.php');?>
  <div class="content-header">
    <?php
    if (isset($_GET['pages'])) {
      switch ($_GET['pages']) {
        case 'home':
          require('./pages/gerant/home.php');
          break;
          case 'ajouter_clients':
          require('./pages/gerant/add.php');
            break;
            case 'adjouter_espaces':
            require('./pages/gerant/add.php');
              break;
              case 'add':
              require('./pages/gerant/add.php');
                break;
              case 'profile':
              require('./pages/gerant/add.php');
                break;
              case 'view':
              require('./pages/gerant/view.php');
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

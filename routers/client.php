<div class="content-wrapper">
  <?php require('./components/menu_client.php');?>
  <div class="content-header">

    <?php
    if (isset($_GET['pages'])) {
      switch ($_GET['pages']) {
        case 'home':
          require('./pages/client/home.php');
          break;
          case 'ajouter_clients':
          require('./pages/client/add.php');
            break;
            case 'adjouter_espaces':
            require('./pages/client/add.php');
              break;
              case 'add':
              require('./pages/client/add.php');
                break;
              case 'profile':
              require('./pages/client/add.php');
                break;
              case 'view':
              require('./pages/client/view.php');
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

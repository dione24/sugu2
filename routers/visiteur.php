<div class="content-wrapper">
  <?php require('./components/menu_visiteur.php');?>
  <div class="content-header">

    <?php
    if (isset($_GET['pages'])) {
      switch ($_GET['pages']) {
        case 'home':
          require('./pages/visiteur/home.php');
          break;
          case 'ajouter_clients':
          require('./pages/visiteur/add.php');
            break;
            case 'adjouter_espaces':
            require('./pages/visiteur/add.php');
              break;
              case 'add':
              require('./pages/visiteur/add.php');
                break;
              case 'profile':
              require('./pages/visiteur/add.php');
                break;
              case 'view':
              require('./pages/visiteur/view.php');
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

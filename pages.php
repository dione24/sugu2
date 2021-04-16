<?php
require('config/function.php');
require('config/dbconfig.php');
logged_only();
Verify();
ob_start();
$url = $_SESSION['statut'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SUGU WEB APP | MLCREANCES</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
    <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <a href="pages.php?access=<?= $url; ?>&pages=home" class="logo">
                <span class="logo-mini"><b>MLC</b></span>
                <span class="logo-lg"><b>MLC </b>SUGU-APP</span>
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <?php if ($_SESSION['statut'] == 'caissiere') {
              require('pages/admin/messages.php');
            } ?>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="hidden-xs"><?= $_SESSION['nom'] . " " . $_SESSION['prenom']; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="pages.php?access=<?= $url; ?>&pages=view&display=user_profile"
                                            class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="config/actions.php?q=logout"
                                            class="btn btn-default btn-flat">Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <?php
    if (isset($_GET['access'])) {
      $route = $_SESSION['statut'];
      switch ($_GET['access']) {
        case 'admin':
          if ($_SESSION['statut'] == 'admin') {
            require('routers/admin.php');
          } else {
            require("routers/$route.php");
          }
          break;
        case 'admin_local':
          if ($_SESSION['statut'] == 'admin_local') {
            require('routers/admin_local.php');
          } else {
            require("routers/$route.php");
          }
          break;
        case 'caissiere':
          if ($_SESSION['statut'] == 'caissiere') {
            require('routers/caissiere.php');
          } else {
            require("routers/$route.php");
          }
          break;
        case 'client':
          if ($_SESSION['statut'] == 'client') {
            require('routers/client.php');
          } else {
            require("routers/$route.php");
          }
          break;
        case 'gerant':
          if ($_SESSION['statut'] == 'gerant') {
            require('routers/gerant.php');
          } else {
            require("routers/$route.php");
          }
          break;
        case 'visiteur':
          if ($_SESSION['statut'] == 'visiteur') {
            require('routers/visiteur.php');
          } else {
            require("routers/$route.php");
          }
          break;
        default:
          echo "<h1>Page not found !</h1>";
          break;
      }
    }
    ?>
        <div class="control-sidebar-bg"></div>
    </div>
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js">
    </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js "></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <script src="bower_components/fastclick/lib/fastclick.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
    <script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="bower_components/chart.js/Chart.js"></script>
    <script src="dist/js/pages/dashboard2.js"></script>
    <script src="dist/js/demo.js"></script>
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="bower_components/ckeditor/ckeditor.js"></script>
    <script type="text/javascript">
    <?php if (isset($_SESSION['flash'])) : ?>
    <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
    $(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        Toast.fire({
            type: '<?= $type; ?>',
            title: '<?= $message; ?>'
        });
        <?php endforeach; ?>
        <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>
    });
    </script>
    <script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]

        });
    });
    </script>
    <script>
    $(function() {
        $('.select2').select2()
    })
    </script>
    <script>
    $(function() {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1')
        //bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5()
    })
    </script>
    <script type="text/javascript" src="bower_components/idle-timer.min.js"></script>
    <script>
    $(document).ready(function() {
        // Set idle time
        $(document).idleTimer(420000);
    });

    $(document).on("idle.idleTimer", function(event, elem, obj) {
        window.location = "config/actions.php?q=logout";
    });
    </script>
</body>
</body>

</html>
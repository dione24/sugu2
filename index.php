<?php
session_start();
if (isset($_SESSION['id_users'])) {
  $url = $_SESSION['statut'];
  header("location: pages.php?access=$url&pages=home");
} ?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>SUGU WEB APP </title>
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css'>
    <link rel="stylesheet" href="bower_components/style.css">
</head>

<body>
    <div class="wrapper">
        <form class="form-signin" action="config/actions.php?q=authentification" method="POST">
            <h2 class="form-signin-heading">Connectez vous</h2>
            <?php require('config/msg_conf.php'); ?>
            <input type="text" class="form-control" name="login" placeholder="Login" required="" autofocus="" />
            </br>
            <input type="password" class="form-control" name="password" placeholder="Password" required="" />
            <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        </form>
    </div>
</body>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
<footer class="sticky-footer">
    <div class="container my-auto">
        <div class="copyright text-center my-auto ">
            <a style="color: white; font-size: 18px;" href="https://malicreances-sa.com"> Copyright Mali Creances 2020 -
                Tous droits réservés </a>
            <!----Powered by Niangaly Abdoulaye 72830996 | dioneniangaly@gmail.com--->
        </div>
    </div>
</footer>
<?php ob_end_flush();  ?>

</html>
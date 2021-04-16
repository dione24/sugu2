
<?php $GetMessages = GetMessages($baseDeDonnee);
     $nombreMessages = CountMessages($baseDeDonnee);
?>
<li class="dropdown messages-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-envelope-o"></i>
    <span class="label label-danger"><?= $nombreMessages;?></span>
  </a>
  <ul class="dropdown-menu">
<li class="header">Vous avez <?= $nombreMessages;?>  messages</li>
<li>
  <ul class="menu">
    <?php foreach ($GetMessages as $key => $AfficherMessages) { ?>
    <li>
      <a href="pages.php?access=gerant&pages=view&display=inbox">
        <div class="pull-left">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <h4>
            <?= $AfficherMessages['bloc'].'-'.$AfficherMessages['numero'];?>
          <small><i class="fa fa-clock-o"></i> <?= date('Y-m-d',strtotime($AfficherMessages['date_notification']));?></small>
        </h4>
        <p><?= $AfficherMessages['reset_message'];?></p>
      </a>
    </li>
  <?php }?>
  </ul>
</li>
<li class="footer"><a href="pages.php?access=gerant&pages=view&display=inbox">Voir Plus</a></li>
</ul>
</li>

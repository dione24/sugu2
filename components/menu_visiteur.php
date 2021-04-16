<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="images/mlc.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?= $_SESSION['login'];?> </p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
      </div>
    </form>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header"></li>
      <li class="active"><a href="pages.php?access=visiteur&pages=home"><i class="fa fa-home"></i> <span>Accueil</span></a></li>
      <li><a href="pages.php?access=visiteur&pages=view&display=espaces_louee"> <i class="fa fa-history"> Espaces loués</i></a></li>
      <li><a href="pages.php?access=visiteur&pages=view&display=espaces_vendu"> <i class="fa fa-reorder"> Espaces Vendus</i></a></li>
      <li><a href="pages.php?access=visiteur&pages=view&display=listes_espaces"> <i class="fa fa-reorder"> Espaces Disponibles</i></a></li>
      <li><a href="pages.php?access=visiteur&pages=view&display=comptabilite"> <i class="fa fa-table"> Operations</i></a></li>
        <li class="treeview">
        <a href="#"><i class="fa fa-cog"></i> <span>Requete</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="pages.php?access=visiteur&pages=view&display=paiement_periode"> <i class="fa fa-spinner"> Paiement/Période</i></a></li>
          <li><a href="pages.php?access=visiteur&pages=view&display=impaye_paiement"><i class="fa fa-table"> Impayé</i></a></li>
        </ul>
      </li>

    </ul>
  </section>
</aside>

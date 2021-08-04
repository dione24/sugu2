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
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                            class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">HEADER</li>
            <li class="active"><a href="pages.php?access=admin&pages=home"><i class="fa fa-home"></i>
                    <span>Accueil</span></a></li>
            <li><a href="#"><i class="fa fa-link"></i> <span>Paiement</span></a></li>
            <li class="treeview">
                <a href="#"><i class="fa fa-table"></i> <span>Afficher</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages.php?access=admin&pages=view&display=espaces_louee"> <i class="fa fa-history">
                                Espace loué</i></a></li>
                    <li><a href="pages.php?access=admin&pages=view&display=espaces_vendu"> <i class="fa fa-reorder">
                                Espace Vendu </i></a></li>
                    <li><a href="pages.php?access=admin&pages=view&display=listes_resilier"> <i class=" fa fa-file">
                                Contrat resiler </i></a></li>
                    <li><a href="pages.php?access=admin&pages=view&display=listes_clients"> <i class="fa fa-male"></i>
                            Clients</a></li>
                    <li><a href="pages.php?access=admin&pages=view&display=listes_espaces"> <i class="fa fa-reorder">
                                Espaces</i></a></li>

                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-table"></i> <span>Operations</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages.php?access=admin&pages=view&display=attente_confirm"> <i class="fa fa-spinner">
                                En attente de confirmation</i></a></li>
                    <li><a href="pages.php?access=admin&pages=view&display=comptabilite"><i class="fa fa-bank">
                                Comptabilité</i></a></li>
                    <li><a href="pages.php?access=admin&pages=view&display=location_paiement"> <i class="fa fa-money">
                                Paiement</i></a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-cog"></i> <span>Requete</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages.php?access=admin&pages=view&display=paiement_periode"> <i class="fa fa-spinner">
                                Paiement/Période</i></a></li>
                    <li><a href="pages.php?access=admin&pages=view&display=requete_paiement"> <i class="fa fa-spinner">
                                Requete Paiement</i></a></li>
                    <li><a href="pages.php?access=admin&pages=view&display=impaye_paiement"><i class="fa fa-table">
                                Impayé</i></a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-pencil"></i> <span>Ajouter</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages.php?access=admin&pages=ajouter_clients&display=add_clients"><i
                                class="fa fa-reorder"> Ajout Client</i></a></li>
                    <li><a href="pages.php?access=admin&pages=adjouter_espaces&display=add_espaces"><i
                                class="fa fa-reorder"> Ajout Espace </i></a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-user"></i> <span>Gestion des Carnets</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages.php?access=admin&pages=view&display=listes_carnets">Listes des Carnets</a></li>
                    <li><a href="#"></a></a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-user"></i> <span>Admin Pannel</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages.php?access=admin&pages=view&display=listes_users">Gestion des Users</a></li>
                    <li><a href="#"></a></a></li>
                </ul>
            </li>
        </ul>
    </section>
</aside>
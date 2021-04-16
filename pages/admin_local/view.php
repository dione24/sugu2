<?php if ($_GET['display'] == 'espaces_louee') {
    $GetEspacesOccupee  = GetEspaceOccupe($baseDeDonnee);  ?>
<section class="content-header">
    <h1>
        Listes des Espaces en Location
        <small>/MLCREANCES</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="pages.php?access=admin_local&pages=home"><i class="fa fa-dashboard"></i> Accueil</a></li>
        <li class="active">Location</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <br />
                    <form method="post" action="">
                        <div class="col-md-1">
                            <div class="form-group">
                                <input type="int" name="year"
                                    value="<?= (isset($_POST['year'])) ? $_POST['year'] : ''; ?>" class="form-control"
                                    placeholder="Year">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </form>
                    <table id="dataTable" class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Bloc-Numero</th>
                                <th>Type</th>
                                <th>Superficie</th>
                                <th>Position</th>
                                <th>Client</th>
                                <th>Total Paiement</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($GetEspacesOccupee as $key => $AfficherEspacesOccupee) {
                                    $montantTotal = 0;
                                    if (isset($_POST['year'])) {
                                        $ImpayeLocation = ImpayeLocation($baseDeDonnee, $AfficherEspacesOccupee['id_espaces'], $_POST['year']);
                                    } else {
                                        $ImpayeLocation = ImpayeLocation($baseDeDonnee, $AfficherEspacesOccupee['id_espaces']);
                                    }
                                    foreach ($ImpayeLocation as $key => $montant) {
                                        $montantTotal += $montant['DATA'];
                                    }     ?>
                            <tr>
                                <td><?= date('Y-m-d', strtotime($AfficherEspacesOccupee['date_location'])); ?></td>
                                <td><?= $AfficherEspacesOccupee['bloc'] . '-' . $AfficherEspacesOccupee['numero']; ?>
                                </td>
                                <td><?= $AfficherEspacesOccupee['type']; ?></td>
                                <td><?= $AfficherEspacesOccupee['superficie']; ?></td>
                                <td><?= $AfficherEspacesOccupee['position']; ?></td>
                                <td><?= $AfficherEspacesOccupee['nom'] . '-' . $AfficherEspacesOccupee['prenom'] . '-' . $AfficherEspacesOccupee['telephone']; ?>
                                </td>
                                <td> <?= $montantTotal; ?></td>
                                <td><button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#query-<?= $AfficherEspacesOccupee['id_espaces']; ?>"><i
                                            class="fa fa-question-circle"></i>
                                    </button>
                                </td>
                            </tr>
                            <div class="modal fade" id="query-<?= $AfficherEspacesOccupee['id_espaces']; ?>"
                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Historique des Paiements</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <?php foreach ($ImpayeLocation as $key => $data) { ?>
                                            <p> <input type="checkbox" <?php if ($data['DATA'] != NULL) { ?> checked=""
                                                    <?php } ?> /> <?= $data['nom_mois'] . ' - ' . $data['DATA']; ?></p>
                                            <?php } ?>
                                            <hr>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Fermer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                        </tbody>
                        <tfoot>
                            <th>Date</th>
                            <th>Bloc-Numero</th>
                            <th>Type</th>
                            <th>Superficie</th>
                            <th>Position</th>
                            <th>Client</th>
                            <th>Total Paiement</th>
                            <th>Actions</th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<?php if ($_GET['display'] == 'espaces_vendu') {
    $GetEspacesVendu  = GetEspacesVendu($baseDeDonnee); ?>
<section class="content-header">
    <h1>
        Listes des Espaces Vendus
        <small>/MLCREANCES</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="pages.php?access=admin_local&pages=home"><i class="fa fa-dashboard"></i> Accueil</a></li>
        <li class="active">Vente</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="dataTable" class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>Bloc-Numero</th>
                                <th>Type</th>
                                <th>Superficie</th>
                                <th>Position</th>
                                <th>Client</th>
                                <th>Montant</th>
                                <th>Date</th>
                                <th>Vendu Par</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($GetEspacesVendu as $key => $AfficherEspacesVendu) { ?>
                            <tr>
                                <td><?= $AfficherEspacesVendu['bloc'] . '-' . $AfficherEspacesVendu['numero']; ?></td>
                                <td><?= $AfficherEspacesVendu['type']; ?></td>
                                <td><?= $AfficherEspacesVendu['superficie']; ?></td>
                                <td><?= $AfficherEspacesVendu['position']; ?></td>
                                <td><?= $AfficherEspacesVendu['nom'] . '-' . $AfficherEspacesVendu['prenom'] . '-' . $AfficherEspacesVendu['telephone']; ?>
                                </td>
                                <td><?= $AfficherEspacesVendu['montant']; ?> </td>
                                <td><?= date('Y-m-d', strtotime($AfficherEspacesVendu['date'])); ?></td>
                                <td><?= $AfficherEspacesVendu['from_paiement']; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <th>Bloc-Numero</th>
                            <th>Type</th>
                            <th>Superficie</th>
                            <th>Position</th>
                            <th>Client</th>
                            <th>Montant</th>
                            <th>Date</th>
                            <th>Vendu Par</th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<?php if ($_GET['display'] == 'listes_clients') {
    $GetCustomers  = GetCustomers($baseDeDonnee); ?>
<section class="content-header">
    <h1>
        Listes des Clients
        <small>/MLCREANCES</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="pages.php?access=admin_local&pages=home"><i class="fa fa-dashboard"></i> Accueil</a></li>
        <li class="active">Clients</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="dataTable" class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Adresse</th>
                                <th>Telephone</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($GetCustomers as $key => $AfficherCustomers) { ?>
                            <tr>
                                <td><?= $AfficherCustomers['nom']; ?></td>
                                <td><?= $AfficherCustomers['prenom']; ?></td>
                                <td><?= $AfficherCustomers['adresse']; ?></td>
                                <td><?= $AfficherCustomers['telephone']; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Adresse</th>
                            <th>Telephone</th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<?php if ($_GET['display'] == 'listes_resilier') {
    $GetResilier  = GetResilier($baseDeDonnee); ?>
<section class="content-header">
    <h1>
        Listes des contrats Résilier
        <small>/MLCREANCES</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="pages.php?access=admin_local&pages=home"><i class="fa fa-dashboard"></i> Accueil</a></li>
        <li class="active">Résilier</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="dataTable" class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>Bloc-Numero</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Adresse</th>
                                <th>Telephone</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($GetResilier as $key => $AfficherResilier) { ?>
                            <tr>
                                <td><?= $AfficherResilier['bloc'] . '-' . $AfficherResilier['numero']; ?></td>
                                <td><?= $AfficherResilier['nom']; ?></td>
                                <td><?= $AfficherResilier['prenom']; ?></td>
                                <td><?= $AfficherResilier['adresse']; ?></td>
                                <td><?= $AfficherResilier['telephone']; ?></td>
                                <td><?= date('Y-m-d', strtotime($AfficherResilier['date_resiliation'])); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <th>Bloc-Numero</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Adresse</th>
                            <th>Telephone</th>
                            <th>Date</th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<?php if ($_GET['display'] == 'listes_espaces') {
    $GetEspaces  = GetEspaces($baseDeDonnee); ?>
<section class="content-header">
    <h1>
        Listes des Espaces
        <small>/MLCREANCES</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="pages.php?access=admin_local&pages=home"><i class="fa fa-dashboard"></i> Accueil</a></li>
        <li class="active">Espaces</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="dataTable" class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>Bloc-Numero</th>
                                <th>Type</th>
                                <th>Superficie</th>
                                <th>Position</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($GetEspaces as $key => $AfficherEspaces) { ?>
                            <tr>
                                <td><?= $AfficherEspaces['bloc'] . '-' . $AfficherEspaces['numero']; ?> </td>
                                <td><?= $AfficherEspaces['type']; ?></td>
                                <td><?= $AfficherEspaces['superficie']; ?></td>
                                <td><?= $AfficherEspaces['position']; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <th>Bloc-Numero</th>
                            <th>Type</th>
                            <th>Superficie</th>
                            <th>Position</th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<?php if ($_GET['display'] == 'comptabilite') {
    $GetPaiements  = GetPaiements($baseDeDonnee); ?>
<section class="content-header">
    <h1>
        Listes des Paiements
        <small>/MLCREANCES</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="pages.php?access=admin_local&pages=home"><i class="fa fa-dashboard"></i> Accueil</a></li>
        <li class="active">Paiements</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="dataTable" class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>Bloc-Numero</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Mois</th>
                                <th>Annee</th>
                                <th>Montant</th>
                                <th>Num_R</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($GetPaiements as $key => $AfficherOperations) { ?>
                            <tr>
                                <td><?= $AfficherOperations['bloc'] . '-' . $AfficherOperations['numero']; ?> </td>
                                <td><?= $AfficherOperations['nom']; ?></td>
                                <td><?= $AfficherOperations['prenom']; ?></td>
                                <td><?= $AfficherOperations['nom_mois']; ?></td>
                                <td><?= $AfficherOperations['annee']; ?></td>
                                <td><?= $AfficherOperations['montant']; ?></td>
                                <td><?= $AfficherOperations['montant_recu']; ?></td>
                                <td><?= date('Y-m-d', strtotime($AfficherOperations['date_recu'])); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <th>Bloc-Numero</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Mois</th>
                            <th>Annee</th>
                            <th>Montant</th>
                            <th>Num_R</th>
                            <th>Date</th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<?php if ($_GET['display'] == 'attente_confirm') {
    $GetConfirmList  = GetConfirmList($baseDeDonnee); ?>
<section class="content-header">
    <h1>
        Listes des Paiements en Attente de confirmation
        <small>/MLCREANCES</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="pages.php?access=admin_local&pages=home"><i class="fa fa-dashboard"></i> Accueil</a></li>
        <li class="active">Paiements</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <?php if (empty($_SESSION['chmod'])) { ?>
                    <button class="btn btn-success" data-toggle="modal"
                        data-target="#verifySession">S'Authentifier</button>
                    <?php } ?>
                    <a href="config/extraire.php" target="_blank" class="btn btn-primary"> Extraire</a></br></br>

                    <table id="dataTable" class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>Bloc-Numero</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Mois</th>
                                <th>Annee</th>
                                <th>Montant</th>
                                <th>Num_R</th>
                                <th>Date</th>
                                <?php if (!empty($_SESSION['chmod'])) { ?>
                                <th>Action</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($GetConfirmList as $key => $AfficherOperations) { ?>
                            <tr>
                                <td><?= $AfficherOperations['bloc'] . '-' . $AfficherOperations['numero']; ?> </td>
                                <td><?= $AfficherOperations['nom']; ?></td>
                                <td><?= $AfficherOperations['prenom']; ?></td>
                                <td><?= $AfficherOperations['nom_mois']; ?></td>
                                <td><?= $AfficherOperations['annee']; ?></td>
                                <td><?= $AfficherOperations['montant']; ?></td>
                                <td><?= $AfficherOperations['montant_recu']; ?></td>
                                <td><?= date('Y-m-d', strtotime($AfficherOperations['date_recu'])); ?></td>
                                <?php if (!empty($_SESSION['chmod'])) { ?> <td> <a class="btn btn-success"
                                        href="config/actions.php?q=confirm_paiement&id_payements=<?= $AfficherOperations['id_payements']; ?>"><i
                                            class="fa fa-check-square"> Confirmer</i></a>
                                    <a class="btn btn-danger"
                                        href="pages.php?access=admin&pages=ajouter_clients&display=reset_message&id_payements=<?= $AfficherOperations['id_payements']; ?>&id_espaces=<?= $AfficherOperations['id_clients_espaces']; ?> "><i
                                            class="fa fa-times"> Rejeter</i></a>
                                </td>
                                <?php } ?>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <th>Bloc-Numero</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Mois</th>
                            <th>Annee</th>
                            <th>Montant</th>
                            <th>Num_R</th>
                            <th>Date</th>
                            <?php if (!empty($_SESSION['chmod'])) { ?>
                            <th>Action</th>
                            <?php } ?>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!--modalPassCode--->
<form method="POST" action="config/actions.php?q=auth_confirm">
    <div class="modal fade" id="verifySession" tabindex="-1" role="dialog" aria-labelledby="verifySession"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Veuillez mettre votre pass code pour acceder à la validation</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="defaultForm-pass" name="url_page" value="<?= $_SERVER['REQUEST_URI']; ?>"
                        class="form-control validate" required>
                    <div class="modal-body">
                        <label data-error="wrong" data-success="right" for="defaultForm-pass">PassCode</label>
                        <input type="password" id="defaultForm-pass" name="auth_confirm" class="form-control validate"
                            required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!--modalPassCode--->
<?php } ?>

<?php if ($_GET['display'] == 'location_paiement') {
    $GetEspacesOccupee  = GetEspaceOccupe($baseDeDonnee);  ?>
<section class="content-header">
    <h1>
        Listes des Espaces en Location
        <small>/MLCREANCES</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="pages.php?access=admin_local&pages=home"><i class="fa fa-dashboard"></i> Accueil</a></li>
        <li class="active">Paiement</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="dataTable" class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>Bloc-Numero</th>
                                <th>Type</th>
                                <th>Superficie</th>
                                <th>Position</th>
                                <th>Client</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($GetEspacesOccupee as $key => $AfficherEspacesOccupee) { ?>
                            <tr>
                                <td><?= $AfficherEspacesOccupee['bloc'] . '-' . $AfficherEspacesOccupee['numero']; ?>
                                </td>
                                <td><?= $AfficherEspacesOccupee['type']; ?></td>
                                <td><?= $AfficherEspacesOccupee['superficie']; ?></td>
                                <td><?= $AfficherEspacesOccupee['position']; ?></td>
                                <td><?= $AfficherEspacesOccupee['nom'] . '-' . $AfficherEspacesOccupee['prenom'] . '-' . $AfficherEspacesOccupee['telephone']; ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <th>Bloc-Numero</th>
                            <th>Type</th>
                            <th>Superficie</th>
                            <th>Position</th>
                            <th>Client</th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<?php if ($_GET['display'] == 'paiement_periode') { ?>
<section class="content-header">
    <h1>
        Listes des Paiements
        <small>/MLCREANCES</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="pages.php?access=admin_local&pages=home"><i class="fa fa-dashboard"></i> Accueil</a></li>
        <li class="active">Paiements</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <br />
                    <form method="post" action="">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>De</label>
                                <input type="date" name="date1" class="form-control" id="exampleInputPassword1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>A</label>
                                <input type="date" name="date2" class="form-control" id="exampleInputPassword1">
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"> Search</i></button>
                        </div>
                    </form>
                    <?php if (isset($_POST['date1']) && isset($_POST['date2'])) {
                            $GetPaiements  = GetPaiementsPeriode($baseDeDonnee, $_POST['date1'], $_POST['date2']); ?>
                    <table id="dataTable" class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>Bloc-Numero</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Mois</th>
                                <th>Annee</th>
                                <th>Montant</th>
                                <th>Num_R</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($GetPaiements as $key => $AfficherOperations) { ?>
                            <tr>
                                <td><?= $AfficherOperations['bloc'] . '-' . $AfficherOperations['numero']; ?> </td>
                                <td><?= $AfficherOperations['nom']; ?></td>
                                <td><?= $AfficherOperations['prenom']; ?></td>
                                <td><?= $AfficherOperations['nom_mois']; ?></td>
                                <td><?= $AfficherOperations['annee']; ?></td>
                                <td><?= $AfficherOperations['montant']; ?></td>
                                <td><?= $AfficherOperations['montant_recu']; ?></td>
                                <td><?= date('Y-m-d', strtotime($AfficherOperations['date_recu'])); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <th>Bloc-Numero</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Mois</th>
                            <th>Annee</th>
                            <th>Montant</th>
                            <th>Num_R</th>
                            <th>Date</th>
                        </tfoot>
                    </table>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<?php if ($_GET['display'] == 'impaye_paiement') {
    $GetMonth  = GetMonth($baseDeDonnee); ?>
<section class="content-header">
    <h1>
        Listes des Paiements
        <small>/MLCREANCES</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="pages.php?access=admin_local&pages=home"><i class="fa fa-dashboard"></i> Accueil</a></li>
        <li class="active">Paiements</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <br />
                    <form method="post" action="">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control col-md-1" name="id_espaces" type="hidden"
                                    value="<?= $GetEspaces['id_espaces']; ?>">
                                <label>Mois</label>
                                <select class="form-control select2" name="id_mois" data-placeholder="Choisir un mois"
                                    style=" text-align: center; width: 100%;">
                                    <option>Choisir..</option>
                                    <?php foreach ($GetMonth as $key => $AfficherMois) { ?>
                                    <option value="<?= $AfficherMois['id_mois']; ?>"><?= $AfficherMois['nom_mois']; ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Année</label>
                                <select class="form-control select2" name="annee" data-placeholder="Choisir un mois"
                                    style=" text-align: center; width: 100%;">
                                    <option>Choisir..</option>
                                    <option>2016</option>
                                    <option>2017</option>
                                    <option>2018</option>
                                    <option>2019</option>
                                    <option>2020</option>
                                    <option>2021</option>
                                    <option>2022</option>
                                </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"> Search</i></button>
                        </div>
                    </form>
                    <?php if (isset($_POST['id_mois']) && isset($_POST['annee']) or isset($_GET['id_mois']) or isset($_GET['annee'])) {
                            if (isset($_POST['id_mois'])) {
                                $GetPaiements  = GetImpaye($baseDeDonnee, $_POST['id_mois'], $_POST['annee']);
                            } elseif (isset($_GET['id_mois'])) {
                                $GetPaiements  = GetImpaye($baseDeDonnee, $_GET['id_mois'], $_GET['annee']);
                            }
                        ?>
                    <table id="dataTable" class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>Bloc-Numero</th>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Telephone</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($GetPaiements as $key => $AfficherOperations) { ?>
                            <tr>
                                <td><?= $AfficherOperations['bloc'] . '-' . $AfficherOperations['numero']; ?> </td>
                                <td><?= $AfficherOperations['nom']; ?></td>
                                <td><?= $AfficherOperations['prenom']; ?></td>
                                <td><?= $AfficherOperations['telephone']; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <th>Bloc-Numero</th>
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Telephone</th>
                        </tfoot>
                    </table>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<?php if ($_GET['display'] == 'user_profile') { ?>
<div class="card">
    <div class="col-lg-12">
        <div style="text-align:center;" class="card-body">
            <h3><?php echo $_SESSION['nom'] . " " . $_SESSION['prenom']; ?></h3>
            </br>
            <a href="pages.php?access=admin_local&pages=profile&display=first" class="btn btn-primary"><i
                    class="fa fa-lock"> Change my Password</i></a>
            <a href="pages.php?access=admin_local&pages=profile&display=passcode" class="btn btn-warning"><i
                    class="fa fa-lock">Passcode</i></a>

        </div>
    </div>
</div>
<?php } ?>

<?php if ($_GET['display'] == 'inbox') {
    $GetMessages = GetMessagesAll($baseDeDonnee);
    $nombreMessages = CountMessages($baseDeDonnee);
?>
<section class="content-header">
    <h1>
        Messages
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Mailbox</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                </div>
                <div class="box-body no-padding">
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <tbody>
                                <?php foreach ($GetMessages as $key => $AfficherMessages) { ?>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td class="mailbox-name"><a
                                            href="#"><?= $AfficherMessages['bloc'] . '-' . $AfficherMessages['numero']; ?></a>
                                    </td>
                                    <td class="mailbox-subject"><b><?= $AfficherMessages['reset_message']; ?></b>
                                    </td>
                                    <td class="mailbox-attachment"></td>
                                    <td class="mailbox-date">
                                        <?= date('Y-m-d', strtotime($AfficherMessages['date_notification'])); ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<?php if ($_GET['display'] == 'listes_carnets') {
    $GetCarnet  = GetCarnet($baseDeDonnee);
?>
<section class="content-header">
    <h1>
        Listes des Carnets
        <small>/MLCREANCES</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="pages.php?access=admin&pages=home"><i class="fa fa-dashboard"></i> Accueil</a></li>
        <li class="active">Users</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <a class="btn btn-primary" href="pages.php?access=admin&pages=add&display=add_carnet"><i
                            class="fa fa-plus"> Ajouter</i></a></br></br>
                    <table id="dataTable" class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>Numero CARNET</th>
                                <th>NUM RECU</th>
                                <th>DETENTEUR</th>
                                <th>UTILISE</th>
                                <th>NBRE RECU/CARNET</th>
                                <th>RESTANT</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($GetCarnet as $key => $AfficherResultat) {
                                    $plage1 = $AfficherResultat['Plage1'];
                                    $plage2 = $AfficherResultat['Plage2'];
                                    $requetePaiement = $baseDeDonnee->prepare("SELECT  COUNT(DISTINCT montant_recu) FROM payements WHERE payements.montant_recu BETWEEN '$plage1' AND '$plage2' AND (confirm_at IS NOT NULL AND reset_id IS NULL) ");
                                    $requetePaiement->execute();
                                    $AfficherPaiement = $requetePaiement->fetchAll();
                                    $Resulat = $AfficherPaiement[0][0];
                                    $NbreCarnet =  $AfficherResultat['Plage2'] - $AfficherResultat['Plage1'] + 1;
                                    $Restant = ($NbreCarnet - $Resulat);
                                ?>
                            <tr>
                                <td style="text-align:center;"><?= $AfficherResultat['NumCarnet']; ?></td>
                                <td><?= $AfficherResultat['Plage1'] . " à " . $AfficherResultat['Plage2']; ?></td>
                                <td><?= $AfficherResultat['Detenteur']; ?></td>
                                <td><?= $Resulat; ?> </td>
                                <td><?= $NbreCarnet; ?></td>
                                <td><?= $Restant; ?></td>
                                <td><button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#modalStatut-<?= $AfficherResultat['NumCarnet']; ?>">
                                        <i class="fa fa-eye"> </i>
                                    </button></td>
                            </tr>
                            <div class="modal fade" id="modalStatut-<?= $AfficherResultat['NumCarnet']; ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Recu pas encore utilisé</h4>
                                        </div>
                                        <div class="modal-body">
                                            <?php for ($i = $plage1; $i <= $plage2; $i++) {
                                                        $VerifyRecu = VerifyRecu($baseDeDonnee, $i); ?>
                                            <?php if (empty($VerifyRecu)) { ?>
                                            <p><?= $i; ?></p>
                                            <?php  }
                                                    } ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left"
                                                data-dismiss="modal">Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <th>Numero CARNET</th>
                            <th>NUM RECU</th>
                            <th>DETENTEUR</th>
                            <th>STATUS</th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>

<?php if ($_GET['display'] == 'listes_non_occupe') {
    $GetEspaces  = GetEspaceNonOccupe($baseDeDonnee); ?>
<section class="content-header">
    <h1>
        Listes des Espaces non Occupés
        <small>/MLCREANCES</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="pages.php?access=admin_local&pages=home"><i class="fa fa-dashboard"></i> Accueil</a></li>
        <li class="active">Espaces</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="dataTable" class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>Bloc-Numero</th>
                                <th>Type</th>
                                <th>Superficie</th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($GetEspaces as $key => $AfficherEspaces) { ?>
                            <tr>
                                <td><?= $AfficherEspaces['bloc'] . '-' . $AfficherEspaces['numero']; ?> </td>
                                <td><?= $AfficherEspaces['type']; ?></td>
                                <td><?= $AfficherEspaces['position']; ?></td>
                                <td><?= $AfficherEspaces['superficie']; ?></td>
                                <td style="text-align:justify; text-color: white;width: auto;"> <a
                                        class="btn btn-success"
                                        href="pages.php?access=admin_local&pages=ajouter_clients&display=louer_espace&id_espaces=<?= $AfficherEspaces['id_espaces']; ?>">Louer</a>
                                    <a class="btn btn-primary"
                                        href="pages.php?access=admin_local&pages=ajouter_clients&display=vente_espace&id_espaces=<?= $AfficherEspaces['id_espaces']; ?>">Vendre</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <th>Bloc-Numero</th>
                            <th>Type</th>
                            <th>Superficie</th>
                            <th>Position</th>
                            <th>Action</th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
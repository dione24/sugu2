
  <?php require('dbconfig.php');
        require('function.php');
        $GetConfirmList  = GetConfirmList($baseDeDonnee);

  ?>
  <h2> Fiche de Paiement </h2>
    <table id="dataTable" class="table table-striped table-bordered table-hover" width="100%">
      <thead>
      <tr>
        <th>Bloc</th>
        <th>Numero</th>
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
        <?php foreach ($GetConfirmList as $key => $AfficherOperations) { ?>
          <tr>
            <td><?=$AfficherOperations['bloc'];?> </td>
            <td><?=$AfficherOperations['numero'];?></td>
            <td><?= $AfficherOperations['nom'];?></td>
            <td><?= $AfficherOperations['prenom'];?></td>
            <td><?= $AfficherOperations['nom_mois'];?></td>
            <td><?= $AfficherOperations['annee'];?></td>
            <td><?= $AfficherOperations['montant'];?></td>
            <td><?= $AfficherOperations['montant_recu'];?></td>
            <td><?= date('Y-m-d',strtotime($AfficherOperations['date_recu']));?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
     <script type="text/javascript" src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="../bower_components/jquery.table2excel.js"> </script>

             <script>
                  $(function() {
                    $("#dataTable").table2excel({
                      exclude: ".noExl",
                      name: "Excel Document Name",
                      filename: "confirmaPaiement.xls",
                      fileext: ".xls",
                      exclude_img: true,
                      exclude_links: true,
                      exclude_inputs: true
                    });
                  });
                </script>

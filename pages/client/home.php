<?php $CountClient = CountClient($baseDeDonnee);
      $CountEspaces = CountEspaces($baseDeDonnee);
      $CountLocation = CountLocation($baseDeDonnee);
      $MontantMonth = MontantMonth($baseDeDonnee);
      $MontantWeek = MontantWeek($baseDeDonnee);
      $monthT= date('m');
      $annee= date('Y');
       $mois = intval($monthT);
  $CountImpaye = CountImpaye($baseDeDonnee,$mois,$annee);

      ?>
<section>
<div class="row">
  <div class="col-lg-4 col-xs-6">
    <div class="small-box bg-green">
      <div class="inner">
        <h3><?= $CountEspaces;?></h3>
        <p>Espaces</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="pages.php?access=client&pages=view&display=listes_espaces" class="small-box-footer">Plus <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-4 col-xs-6">
    <div class="small-box bg-yellow">
      <div class="inner">
        <h3><?= $CountLocation;?></h3>
        <p>Espaces Occupés</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      <a href="pages.php?access=client&pages=view&display=espaces_louee" class="small-box-footer">Plus <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>
      <div class="col-lg-4 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <h3><?= $CountEspaces  -  $CountLocation;?></h3>
        <p>Espaces Non  Occupés</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
     <a href="pages.php?access=client&pages=view&display=listes_non_occupe" class="small-box-footer">Plus <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>

</div>
<div class="row">
  <div class="col-md-12">
    <div>
        <h1 style='text-align: center; padding:80px;'>MLC SUGU-WEB-APP</h1><h2 style='text-align: center;'></h2>
    </div>
    <div class="box">
      <div class="box-footer">
        <div class="row">
          <div class="col-sm-6 col-xs-6">
            <div class="description-block border-right">
              <span class="description-percentage text-green"><i class="fa fa-caret-left"></i> <?=$MontantWeek;?></span>
              <h5 class="description-header">FCFA</h5>
              <span class="description-text">REVENUE /SEMAINE</span>
            </div>
          </div>
          <div class="col-sm-6 col-xs-6">
            <div class="description-block border-right">
              <span class="description-percentage text-yellow"><i class="fa fa-caret-right"></i> <?= $MontantMonth;?></span>
              <h5 class="description-header">FCFA</h5>
              <span class="description-text">REVENUE /MOIS</span>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
</div>
</section>

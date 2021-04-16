<?php if($_GET['display'] =='add_clients'){?>
<section  class="content">
  <div class="row">
    <div style="" class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Veuillez renseigner le formulaire</h3>
        </div>
        <form method="post" action="config/actions.php?q=add_clients"role="form">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Nom</label>
              <input type="text" name="nom" class="form-control" id="exampleInputEmail1" placeholder="Veuillez entrer le nom du client">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Prenom</label>
              <input type="text" name="prenom" class="form-control" id="exampleInputPassword1" placeholder="Veuillez entrer le prenom du client">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Adresse</label>
              <input type="text" name="adresse" class="form-control" id="exampleInputPassword1" placeholder="Veuillez entrer l'adresse du client">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Telephone</label>
              <input type="number" name="telephone" class="form-control" id="exampleInputPassword1" placeholder="Veuillez entrer le telephone du client">
            </div>
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Enregister</button>
          </div>
        </form>
        </div>
        </div>
        </div>
      </section>
    <?php } ?>
    <?php if($_GET['display'] =='add_espaces'){?>
    <section  class="content">
      <div class="row">
        <div style="" class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Veuillez renseigner le formulaire</h3>
            </div>
            <form  method="post" action="config/actions.php?q=add_espaces"role="form">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Numero</label>
                  <input name="numero" type="number" class="form-control" id="exampleInputEmail1" placeholder="Veuillez  choisir le type de l'espace">
                </div>
                  <div class="form-group">
                    <label>Type d'espaces</label>
                    <select name="type" class="form-control select2" style="width: 100%;">
                      <option>MAGASIN</option>
                      <option>ETALES</option>
                      <option>TOILLETE</option>
                      <option>PARKING</option>
                    </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Superficie</label>
                  <input name="superficie" type="text" class="form-control" id="exampleInputPassword1" placeholder="Veuillez entrer la superficie de l'espace">
                </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Position</label>
                    <input name="position" type="text" class="form-control" id="exampleInputPassword1" placeholder="Veuillez entrer la position de l'espace">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Bloc</label>
                    <input name="bloc" type="text" class="form-control" id="exampleInputPassword1" placeholder="Veuillez entrer le bloc de l'espace">
                  </div>
                </div>
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Enregister</button>
                </div>
              </form>
              </div>
              </div>
              </div>
            </section>
        <?php } ?>
        <?php if($_GET['display'] =='update_clients'){
            $UpdateCustomers = UpdateCustomers($baseDeDonnee,$_GET['id_clients']);  ?>
        <section  class="content">
          <div class="row">
            <div style="" class="col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Veuillez renseigner le formulaire</h3>
                </div>
                <form method="post" action="config/actions.php?q=update_clients"role="form">
                  <div class="box-body">
                    <input type="hidden" name="id_clients" value="<?= $UpdateCustomers['id_clients'];?>" class="form-control" id="exampleInputEmail1" placeholder="Veuillez entrer le nom du client">

                    <div class="form-group">
                      <label for="exampleInputEmail1">Nom</label>
                      <input type="text" name="nom" value="<?= $UpdateCustomers['nom'];?>" class="form-control" id="exampleInputEmail1" placeholder="Veuillez entrer le nom du client">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Prenom</label>
                      <input type="text" name="prenom" value="<?= $UpdateCustomers['prenom'];?>" class="form-control" id="exampleInputPassword1" placeholder="Veuillez entrer le prenom du client">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Adresse</label>
                      <input type="text" name="adresse"  value="<?= $UpdateCustomers['adresse'];?>" class="form-control" id="exampleInputPassword1" placeholder="Veuillez entrer l'adresse du client">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Telephone</label>
                      <input type="number" name="telephone" value="<?= $UpdateCustomers['telephone'];?>" class="form-control" id="exampleInputPassword1" placeholder="Veuillez entrer le telephone du client">
                    </div>
                  </div>
                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Enregister</button>
                  </div>
                </form>
                </div>
                </div>
                </div>
              </section>
            <?php } ?>
            <?php if($_GET['display'] =='update_epaces'){
              $UpdateEspaces = UpdateEspaces($baseDeDonnee,$_GET['id_espaces']); ?>
            <section  class="content">
              <div class="row">
                <div style="" class="col-md-12">
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Veuillez renseigner le formulaire</h3>
                    </div>
                    <form  method="post" action="config/actions.php?q=update_espaces"role="form">
                      <div class="box-body">
                        <div class="form-group">
                          <input name="id_espaces" type="hidden" value="<?= $UpdateEspaces['id_espaces'];?>" class="form-control" id="exampleInputEmail1" placeholder="Veuillez  choisir le type de l'espace">
                          <label for="exampleInputEmail1">Numero</label>
                          <input name="numero" type="text" value="<?= $UpdateEspaces['numero'];?>" class="form-control" id="exampleInputEmail1" placeholder="Veuillez  choisir le type de l'espace">
                        </div>
                          <div class="form-group">
                            <label>Type d'espaces</label>
                            <select name="type" class="form-control select2" style="width: 100%;">
                              <option>MAGASIN</option>
                              <option>ETALES</option>
                              <option>TOILLETE</option>
                              <option>PARKING</option>
                            </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Superficie</label>
                          <input name="superficie" type="text" value="<?= $UpdateEspaces['superficie'];?>" class="form-control" id="exampleInputPassword1" placeholder="Veuillez entrer la superficie de l'espace">
                        </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Position</label>
                            <input name="position" type="text" value="<?= $UpdateEspaces['position'];?>" class="form-control" id="exampleInputPassword1" placeholder="Veuillez entrer la position de l'espace">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Bloc</label>
                            <input name="bloc" type="text" class="form-control" value="<?= $UpdateEspaces['bloc'];?>" id="exampleInputPassword1" placeholder="Veuillez entrer le bloc de l'espace">
                          </div>
                        </div>
                        <div class="box-footer">
                          <button type="submit" class="btn btn-primary">Enregister</button>
                        </div>
                      </form>
                      </div>
                      </div>
                      </div>
                    </section>
                <?php } ?>
                <?php if($_GET['display'] == 'louer_espace'){
                  $GetCustomers  = GetCustomers($baseDeDonnee);
                  $GetEspaces = UpdateEspaces($baseDeDonnee,$_GET['id_espaces']);?>
                  <section class="content-header">
                    <h1>
                        Louer un Espace
                      <small>/MALI MLCREANCES</small>
                    </h1>
                    <ol class="breadcrumb">
                      <li><a href="pages.php?access=admin&pages=home"><i class="fa fa-dashboard"></i> Accueil</a></li>
                      <li class="active">Location</li>
                    </ol>
                  </section>
                  <section class="content">
                  <div class="box box-default">
                    <div class="box-header with-border">
                      <h3 class="box-title">Location</h3>
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                      </div>
                    </div>
                    <form method="post" action="config/actions.php?q=louer">
                    <div class="box-body">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <input class="form-control col-md-1" name="id_espaces" type="hidden"  value="<?= $GetEspaces['id_espaces'];?>">
                            <label>Client</label>
                            <select class="form-control select2" name="id_clients"  data-placeholder="Choisir un  client"
                                    style=" text-align: center; width: 100%;">
                                    <option>Choisir un client</option>
                              <?php foreach ($GetCustomers as $key => $afficherClient) { ?>
                              <option value="<?= $afficherClient['id_clients'];?>"><?= $afficherClient['nom']." ".$afficherClient['prenom'];?></option>
                            <?php } ?>
                              </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Bloc et Numero</label>
                            <input name="position" type="text" value="<?= $GetEspaces['bloc'].'-'.$GetEspaces['numero'];?>" class="form-control" id="exampleInputPassword1" readonly >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="box-footer">
                      <button type="submit" class="btn btn-success">Allouer</button>
                    </div>
                  </form>
                  </div>
                </section>
              <?php }?>
                <?php if($_GET['display'] == 'vente_espace'){
                  $GetCustomers  = GetCustomers($baseDeDonnee);
                  $GetEspaces = UpdateEspaces($baseDeDonnee,$_GET['id_espaces']);?>
                  <section class="content-header">
                    <h1>
                        Vendre un Espace
                      <small>/MLCREANCES</small>
                    </h1>
                    <ol class="breadcrumb">
                      <li><a href="pages.php?access=admin&pages=home"><i class="fa fa-dashboard"></i> Accueil</a></li>
                      <li class="active">Vente</li>
                    </ol>
                  </section>
                  <section class="content">
                  <div class="box box-default">
                    <div class="box-header with-border">
                      <h3 class="box-title">Location</h3>
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                      </div>
                    </div>
                    <form method="post" action="config/actions.php?q=vente_espace">
                    <div class="box-body">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <input class="form-control col-md-1" name="id_espaces" type="hidden"  value="<?= $GetEspaces['id_espaces'];?>">
                            <label>Client</label>
                            <select class="form-control select2" name="id_clients"  data-placeholder="Choisir un  client"
                                    style=" text-align: center; width: 100%;">
                                    <option>Choisir un client</option>
                              <?php foreach ($GetCustomers as $key => $afficherClient) { ?>
                              <option value="<?= $afficherClient['id_clients'];?>"><?= $afficherClient['nom']." ".$afficherClient['prenom'];?></option>
                            <?php } ?>
                              </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Bloc et Numero</label>
                            <input type="text" value="<?= $GetEspaces['bloc'].'-'.$GetEspaces['numero'];?>" class="form-control" id="exampleInputPassword1" readonly >
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Montant</label>
                            <input  type="int"  name="montant" class="form-control" id="exampleInputPassword1" >
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Date</label>
                            <input  type="date"  name="date" class="form-control" id="exampleInputPassword1" >
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Payé chez</label>
                            <select class="form-control " name="from_paiement"  data-placeholder="Choisir un  client"
                                    style=" text-align: center; width: 100%;">
                                    <option>Choisir...</option>
                                    <option>MLC</option>
                                    <option>BMS</option>
                              </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="box-footer">
                      <button type="submit" class="btn btn-success">Valider</button>
                    </div>
                  </form>
                  </div>
                </section>
                <?php }?>
                <?php if($_GET['display'] == 'reset_message'){ ?>
                  <section class="content-header">
                    <h1>
                        Rejet
                      <small>/MLCREANCES</small>
                    </h1>
                    <ol class="breadcrumb">
                      <li><a href="pages.php?access=admin&pages=home"><i class="fa fa-dashboard"></i> Accueil</a></li>
                      <li class="active">Paiement</li>
                    </ol>
                  </section>
                  <section class="content">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="box box-info">
                          <div class="box-header">
                            <h3 class="box-title">Veuillez entrer la raison du Rejet
                            </h3>
                            <div class="pull-right box-tools">
                              <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                                      title="Collapse">
                                <i class="fa fa-minus"></i></button>
                              <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                                      title="Remove">
                                <i class="fa fa-times"></i></button>
                            </div>
                          </div>
                          <form method="post" action="config/actions.php?q=reset_operation">
                          <div class="box-body pad">
                              <input type="hidden" name="id_payements" value="<?= $_GET['id_payements'];?>">
                              <input type="hidden" name="id_espaces" value="<?= $_GET['id_espaces'];?>">
                                  <textarea id="editor1" name="reset_message" rows="10" cols="80">
                                  </textarea>
                          </div>
                          <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                          </div>
                              </form>
                        </div>
                      </div>
                    </div>
                </section>
                <?php }?>
                <?php if($_GET['display'] == 'paiement_location'){
                  $GetMonth  = GetMonth($baseDeDonnee);
                  $GetEspaces = UpdateEspaces($baseDeDonnee,$_GET['id_espaces']);?>
                  <section class="content-header">
                    <h1>
                        Effectuer  un Paiement
                      <small>/MLCREANCES</small>
                    </h1>
                    <ol class="breadcrumb">
                      <li><a href="pages.php?access=admin&pages=home"><i class="fa fa-dashboard"></i> Accueil</a></li>
                      <li class="active">Paiement</li>
                    </ol>
                  </section>
                  <section class="content">
                  <div class="box box-default">
                    <div class="box-header with-border">
                      <h3 class="box-title">Location</h3>
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                      </div>
                    </div>
                    <form method="post" action="config/actions.php?q=paiement_location">
                    <div class="box-body">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <input class="form-control col-md-1" name="id_espaces" type="hidden"  value="<?= $GetEspaces['id_espaces'];?>">
                            <label>Mois</label>
                            <select class="form-control select2" name="id_mois"  data-placeholder="Choisir un mois"
                                    style=" text-align: center; width: 100%;">
                                    <option>Choisir..</option>
                              <?php foreach ($GetMonth as $key => $AfficherMois) { ?>
                              <option value="<?= $AfficherMois['id_mois'];?>"><?= $AfficherMois['nom_mois'];?></option>
                            <?php } ?>
                              </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Annee</label>
                            <select class="form-control select2" name="annee"  data-placeholder="Choisir un  client"
                                    style=" text-align: center; width: 100%;">
                                    <option>Choisir..</option>
                                    <option> 2016 </option>
                                    <option> 2017 </option>
                                    <option> 2018 </option>
                                    <option> 2019 </option>
                                    <option> 2020 </option>
                                    <option> 2021 </option>
                                    <option> 2022 </option>
                              </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Montant</label>
                            <input  type="int"  name="montant" class="form-control" id="exampleInputPassword1" >
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Date</label>
                            <input  type="date"  name="date_recu" class="form-control" id="exampleInputPassword1" >
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Numero Recu</label>
                            <input  type="int"  name="montant_recu" class="form-control" id="exampleInputPassword1" >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="box-footer">
                      <button type="submit" class="btn btn-success">Valider</button>
                    </div>
                  </form>
                  </div>
                </section>
                <?php }?>
                <?php if($_GET['display'] =='first'){?>
                <section  class="content">
                  <div class="row">
                    <div style="  margin-left: 200px; margin-right: auto;" class="col-md-6">
                      <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">Entrer votre ancien Mot de Passe</h3>
                        </div>
                        <form method="post" action="config/actions.php?q=check_password"role="form">
                          <div class="box-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Password</label>
                              <input type="password" name="password" class="form-control" id="exampleInputEmail1" required>
                            </div>
                          <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Suivant</button>
                          </div>
                        </form>
                        </div>
                        </div>
                        </div>
                      </section>
                    <?php } ?>
                    <?php if($_GET['display'] =='second'){?>
                    <section   class="content">
                      <div class="row">
                        <div style="  margin-left: 200px; margin-right: auto;" class="col-md-6">
                          <div class="box box-primary">
                            <div class="box-header with-border">
                              <h3 class="box-title">Entrer votre nouveau Mot de Passe</h3>
                            </div>
                            <form method="post" action="config/actions.php?q=update_password"role="form">
                              <div class="box-body">
                                <div class="form-group">
                                  <label for="exampleInputEmail1">Password</label>
                                  <input type="password" name="password" class="form-control" id="exampleInputEmail1"  required>
                                </div>
                              </div>
                              <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Changer</button>
                              </div>
                            </form>
                            </div>
                            </div>
                            </div>
                          </section>
                        <?php } ?>
                        <?php if($_GET['display'] =='add_users'){?>
                        <section  class="content">
                          <div class="row">
                            <div style="" class="col-md-10">
                              <div class="box box-primary">
                                <div class="box-header with-border">
                                  <h3 class="box-title">Veuillez renseigner le formulaire</h3>
                                </div>
                                <form method="post" action="config/actions.php?q=add_users"role="form">
                                  <div class="box-body">
                                    <div class="form-group">
                                      <label for="exampleInputEmail1">Nom</label>
                                      <input type="text" name="nom" class="form-control" id="exampleInputEmail1">
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">Prenom</label>
                                      <input type="text" name="prenom" class="form-control" id="exampleInputPassword1" >
                                    </div>
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">Login</label>
                                      <input type="text" name="login" class="form-control" id="exampleInputPassword1">
                                    </div>
                                      <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control select2" name="status"  data-placeholder="Choisir un  client"
                                                style=" text-align: center; width: 100%;">
                                                <option>Choisir..</option>
                                                <option>caissiere</option>
                                                <option>admin</option>
                                                <option>gerant</option>
                                                <option>client</option>
                                                <option>admin_local</option>
                                          </select>
                                      </div>
                                    <div class="form-group">
                                      <label for="exampleInputPassword1">Password</label>
                                      <input type="password" name="password" class="form-control" id="exampleInputPassword1" >
                                    </div>
                                  </div>
                                  <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                  </div>
                                </form>
                                </div>
                                </div>
                                </div>
                              </section>
                            <?php } ?>
                            <?php if($_GET['display'] =='update_users'){
                                $GetUsers  = SingleUser($baseDeDonnee,$_GET['id_users']);?>
                            <section  class="content">
                              <div class="row">
                                <div style="" class="col-md-10">
                                  <div class="box box-primary">
                                    <div class="box-header with-border">
                                      <h3 class="box-title">Veuillez renseigner le formulaire</h3>
                                    </div>
                                    <form method="post" action="config/actions.php?q=update_users"role="form">
                                      <div class="box-body">
                                        <div class="form-group">
                                          <input type="hidden" name="id_users" value="<?= $GetUsers['id_users'];?>" class="form-control" id="exampleInputPassword1">
                                          <label for="exampleInputEmail1">Nom</label>
                                          <input type="text" name="nom" value="<?= $GetUsers['nom'];?>" class="form-control" id="exampleInputEmail1">
                                        </div>
                                        <div class="form-group">
                                          <label for="exampleInputPassword1">Prenom</label>
                                          <input type="text" name="prenom" value="<?= $GetUsers['prenom'];?>" class="form-control" id="exampleInputPassword1" >
                                        </div>
                                        <div class="form-group">
                                          <label for="exampleInputPassword1">Login</label>
                                          <input type="text" name="login" value="<?= $GetUsers['login'];?>" class="form-control" id="exampleInputPassword1">
                                        </div>
                                        <div class="form-group">
                                          <label for="exampleInputPassword1">Password</label>
                                          <input type="password" name="password" class="form-control" id="exampleInputPassword1" >
                                        </div>
                                          <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control select2" name="status"  data-placeholder="Choisir un  client"
                                                    style=" text-align: center; width: 100%;">
                                                    <option>Choisir..</option>
                                                    <option>caissiere</option>
                                                    <option>admin</option>
                                                    <option>gerant</option>
                                                    <option>client</option>
                                                    <option>admin_local</option>
                                              </select>
                                          </div>
                                        <div class="form-group">
                                          <label for="exampleInputPassword1">Passcode</label>
                                          <input type="password" name="auth_confirm"  class="form-control" id="exampleInputPassword1" >
                                        </div>
                                      </div>
                                      <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Valider</button>
                                      </div>
                                    </form>
                                    </div>
                                    </div>
                                    </div>
                                  </section>
                                <?php } ?>

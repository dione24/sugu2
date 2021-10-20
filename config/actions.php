<?php
session_start();
require('dbconfig.php');
require('function.php');
$url = $_SESSION['statut'];
if (isset($_GET['q'])) {
  switch ($_GET['q']) {
    case "authentification":
      if (!empty($_POST['login']) && !empty($_POST['password'])) {
        $query = $baseDeDonnee->prepare('SELECT * FROM users WHERE login =:login ');
        $query->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
        $query->execute();
        $data = $query->fetch();
        $query->CloseCursor();
        if (password_verify($_POST['password'], $data['password'])) {
          $_SESSION['id_users'] = $data['id_users'];
          $_SESSION['login'] = $data['login'];
          $_SESSION['statut'] = $data['status'];
          $_SESSION['nom'] = $data['nom'];
          $_SESSION['prenom'] = $data['prenom'];
          if ($_SESSION['statut'] == 'client') {
            header('location: ../pages.php?access=client&pages=home');
          } elseif ($_SESSION['statut'] == 'admin') {
            header('location: ../pages.php?access=admin&pages=home');
          } elseif ($_SESSION['statut'] == 'admin_local') {
            header('location: ../pages.php?access=admin_local&pages=home');
          } elseif ($_SESSION['statut'] == 'caissiere') {
            header('location: ../pages.php?access=caissiere&pages=home');
          } elseif ($_SESSION['statut'] == 'gerant') {
            header('location: ../pages.php?access=gerant&pages=home');
          } elseif ($_SESSION['statut'] == 'visiteur') {
            header('location: ../pages.php?access=visiteur&pages=home');
          }
        } else {
          header('location: ../?msg=1');
          exit();
        }
      } else {
        header('location: ../index.php');
        exit();
      }
      break;
    case 'logout':
      session_destroy();
      header('location: ../?msg=1');
      break;

    case 'add_clients':
      if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['adresse']) && !empty($_POST['telephone'])) {
        $requeteAddClients = $baseDeDonnee->prepare('INSERT INTO clients (nom,prenom,adresse,telephone) VALUES(:nom,:prenom,:adresse,:telephone)');
        $requeteAddClients->bindValue(':nom', $_POST['nom'],  PDO::PARAM_STR);
        $requeteAddClients->bindValue(':prenom', $_POST['prenom'],  PDO::PARAM_STR);
        $requeteAddClients->bindValue(':adresse', $_POST['adresse'],  PDO::PARAM_STR);
        $requeteAddClients->bindValue(':telephone', $_POST['telephone'],  PDO::PARAM_STR);
        $requeteAddClients->execute();
        header("location: ../pages.php?access=$url&pages=ajouter_clients&display=add_clients.php");
        $_SESSION['flash']['success'] = "Inscription Effectuée";
      } else {
        header("location: ../pages.php?access=$url&pages=ajouter_clients&display=add_clients");
        $_SESSION['flash']['warning'] = "Veuillez remplir correctement le formulaire ";
      }
      break;

    case 'delete_clients':
      $requeteDeleteSelection = $baseDeDonnee->prepare("DELETE FROM clients WHERE id_clients=:id_clients");
      $requeteDeleteSelection->bindValue(':id_clients', $_GET['id_clients'], PDO::PARAM_STR);
      $requeteDeleteSelection->execute();
      header("location: ../pages.php?access=$url&pages=view&display=listes_clients");
      break;

    case "add_espaces":
      if (!empty($_POST['numero']) && !empty($_POST['type'])  && !empty($_POST['superficie'])  && !empty($_POST['position'])  && !empty($_POST['bloc'])) {
        $requeteVerifyEspaces = $baseDeDonnee->prepare("SELECT * FROM espaces WHERE numero=:numero  AND bloc=:bloc AND type=:type ");
        $requeteVerifyEspaces->bindValue(':numero', $_POST['numero'], PDO::PARAM_INT);
        $requeteVerifyEspaces->bindValue(':bloc', $_POST['bloc'], PDO::PARAM_STR);
        $requeteVerifyEspaces->bindValue(':type', $_POST['type'], PDO::PARAM_STR);
        $requeteVerifyEspaces->execute();
        $ResultatVerify = $requeteVerifyEspaces->fetch();
        if (strtolower($ResultatVerify['bloc']) == strtolower($_POST['bloc']) && $ResultatVerify['numero'] == $_POST['numero'] && $ResultatVerify['type'] == $_POST['type']) {
          header("location: ../pages.php?access=$url&pages=ajouter_clients&display=add_espaces");
          $_SESSION['flash']['danger'] = "Ce numero est déjà pris, Veuillez saisir un autre numéro";
        } else {
          $requeteAddEspaces = $baseDeDonnee->prepare('INSERT INTO espaces (numero,type,superficie,position,bloc) VALUES(:numero,:type,:superficie,:position,:bloc)');
          $requeteAddEspaces->bindValue(':numero', $_POST['numero'],  PDO::PARAM_INT);
          $requeteAddEspaces->bindValue(':type', $_POST['type'],  PDO::PARAM_STR);
          $requeteAddEspaces->bindValue(':superficie', $_POST['superficie'],  PDO::PARAM_STR);
          $requeteAddEspaces->bindValue(':position', $_POST['position'],  PDO::PARAM_STR);
          $requeteAddEspaces->bindValue(':bloc', $_POST['bloc'],  PDO::PARAM_STR);
          $requeteAddEspaces->execute();
          header("location: ../pages.php?access=$url&pages=ajouter_clients&display=add_espaces");
          $_SESSION['flash']['success'] = "Opération Effectuée";
        }
      } else {
        header("location: pages.php?access=$url&pages=ajouter_clients&display=add_espaces");
        $_SESSION['flash']['danger'] = " Veuillez saisir les informations";
      }
      break;

    case 'delete_espaces':
      $requeteDeleteSelection = $baseDeDonnee->prepare("UPDATE espaces SET Delete_id=:user,Delete_at=:day WHERE id_espaces=:id_espaces");
      $requeteDeleteSelection->bindValue(':id_espaces', $_GET['id_espaces'], PDO::PARAM_STR);
      $requeteDeleteSelection->bindValue(':user', $_SESSION['id_users'], PDO::PARAM_INT);
      $requeteDeleteSelection->bindValue(':day', date('Y-m-d H:i:s'), PDO::PARAM_STR);
      $requeteDeleteSelection->execute();
      header("location: ../pages.php?access=$url&pages=view&display=listes_espaces");
      break;

    case 'resilier_espaces':
      if (!empty($_GET['id_location']) && !empty($_GET['id_espaces'])) {
        $requete = $baseDeDonnee->prepare('UPDATE location set statut_location=2,agent_resiliation=:user,date_resilisation=:day  WHERE id_location=:id_location AND id_espaces=:id_espaces');
        $requete->bindValue(':id_location', $_GET['id_location'], PDO::PARAM_INT);
        $requete->bindValue(':id_espaces', $_GET['id_espaces'], PDO::PARAM_INT);
        $requete->bindValue(':user', $_SESSION['id_users'], PDO::PARAM_INT);
        $requete->bindValue(':day', date('Y-m-d H:i:s'), PDO::PARAM_INT);
        $requete->execute();
        header("location: ../pages.php?access=$url&pages=view&display=espaces_louee");
        $_SESSION['flash']['success'] = "Opération  Effectuée";
      } else {
        header("location: ../pages.php?access=$url&pages=view&display=espaces_louee");
        $_SESSION['flash']['warning'] = "Opération non Effectuée";
      }
      break;
    case 'update_clients':

      $requeteUpdate = $baseDeDonnee->prepare("UPDATE clients SET nom=:nom,prenom=:prenom,adresse=:adresse,	telephone=:telephone WHERE id_clients=:id_clients");
      $requeteUpdate->bindValue(':id_clients', $_POST['id_clients'], PDO::PARAM_INT);
      $requeteUpdate->bindValue(':nom', $_POST['nom'],  PDO::PARAM_STR);
      $requeteUpdate->bindValue(':prenom', $_POST['prenom'],  PDO::PARAM_STR);
      $requeteUpdate->bindValue(':adresse', $_POST['adresse'],  PDO::PARAM_STR);
      $requeteUpdate->bindValue(':telephone', $_POST['telephone'],  PDO::PARAM_STR);
      $requeteUpdate->execute();
      header("location: ../pages.php?access=$url&pages=view&display=listes_clients");
      $_SESSION['flash']['success'] = "Opération  Effectuée";
      break;

    case 'delete_resilier':
      $requeteDeleteSelection = $baseDeDonnee->prepare("DELETE FROM resiliation WHERE id_resiliation=:id_resiliation");
      $requeteDeleteSelection->bindValue(':id_resiliation', $_GET['id_resiliation'], PDO::PARAM_STR);
      $requeteDeleteSelection->execute();
      header("location: ../pages.php?access=$url&pages=view&display=listes_resilier");
      break;

    case 'update_espaces':
      $requeteUpdateEspaces = $baseDeDonnee->prepare("UPDATE  espaces SET numero=:numero,type=:type,superficie=:superficie,position=:position,bloc=:bloc WHERE id_espaces=:id_espaces");
      $requeteUpdateEspaces->bindValue(':id_espaces', $_POST['id_espaces'],  PDO::PARAM_INT);
      $requeteUpdateEspaces->bindValue(':numero', $_POST['numero'],  PDO::PARAM_STR);
      $requeteUpdateEspaces->bindValue(':type', $_POST['type'],  PDO::PARAM_STR);
      $requeteUpdateEspaces->bindValue(':superficie', $_POST['superficie'],  PDO::PARAM_STR);
      $requeteUpdateEspaces->bindValue(':position', $_POST['position'],  PDO::PARAM_STR);
      $requeteUpdateEspaces->bindValue(':bloc', $_POST['bloc'],  PDO::PARAM_STR);
      $requeteUpdateEspaces->execute();
      header("location: ../pages.php?access=$url&pages=view&display=listes_espaces");
      $_SESSION['flash']['success'] = "Opération  Effectuée";
      break;

    case 'louer':
      if (!empty($_POST['id_clients']) && !empty($_POST['id_espaces'])) {
        $requete = $baseDeDonnee->prepare('SELECT * FROM location WHERE id_espaces=:espaces  AND statut_location=1 AND agent_resiliation IS NULL  LIMIT 0,1 ');
        $requete->bindValue(':id_espaces', $_POST['id_espaces'], PDO::PARAM_INT);
        $requete->execute();
        $data = $requete->fetch();
        if (!empty($data)) {
          header("location: ../pages.php?access=$url&pages=view&display=listes_espaces");
          $_SESSION['flash']['warning'] = "Cette location existe dans le systeme";
        } else {

          $requeteAddLocation = $baseDeDonnee->prepare('INSERT INTO location (id_clients, id_espaces,agent_insert,statut_location) VALUES(:id_clients,:id_espaces,:agent_insert,:statut_location)');
          $requeteAddLocation->bindValue(':id_clients', $_POST['id_clients'],  PDO::PARAM_INT);
          $requeteAddLocation->bindValue(':id_espaces', $_POST['id_espaces'],  PDO::PARAM_INT);
          $requeteAddLocation->bindValue(':agent_insert', $_SESSION['id_users'],  PDO::PARAM_INT);
          $requeteAddLocation->bindValue(':statut_location', 1,  PDO::PARAM_INT);
          $requeteAddLocation->execute();
          header("location: ../pages.php?access=$url&pages=view&display=listes_espaces");
          $_SESSION['flash']['success'] = "Opération  Effectuée";
        }
      } else {
        header("location: ../pages.php?access=$url&pages=view&display=listes_espaces");
        $_SESSION['flash']['warning'] = "Opération non Effectuée";
      }
      break;

    case 'vente_espace':
      if (!empty($_POST['id_clients']) && !empty($_POST['id_espaces']) && !empty($_POST['montant']) && !empty($_POST['from_paiement']) && !empty($_POST['date'])) {
        $requeteInsert = $baseDeDonnee->prepare('INSERT INTO vendre (id_clients, id_espaces,montant,from_paiement,date) VALUES(:id_clients,:id_espaces,:montant,:from_paiement,:date)');
        $requeteInsert->bindValue(':id_clients', $_POST['id_clients'],  PDO::PARAM_INT);
        $requeteInsert->bindValue(':id_espaces', $_POST['id_espaces'],  PDO::PARAM_INT);
        $requeteInsert->bindValue(':montant', $_POST['montant'],  PDO::PARAM_INT);
        $requeteInsert->bindValue(':from_paiement', $_POST['from_paiement'], PDO::PARAM_STR);
        $requeteInsert->bindValue(':date', $_POST['date'],  PDO::PARAM_STR);
        $requeteInsert->execute();
        $queryUpdate = $baseDeDonnee->prepare('UPDATE  espaces SET  vend_at = NOW()  WHERE  id_espaces=:id_espaces');
        $queryUpdate->bindValue(':id_espaces', $_POST['id_espaces'], PDO::PARAM_INT);
        $queryUpdate->execute();
        header("location: ../pages.php?access=$url&pages=view&display=listes_espaces");
        $_SESSION['flash']['success'] = "Opération  Effectuée";
      } else {
        header("location: ../pages.php?access=$url&pages=view&display=listes_espaces");
        $_SESSION['flash']['warning'] = "Opération non  Effectuée";
      }
      break;
    case 'delete_paiement':
      $requeteDeleteSelection = $baseDeDonnee->prepare("DELETE FROM payements WHERE id_payements=:id_payements");
      $requeteDeleteSelection->bindValue(':id_payements', $_GET['id_payements'], PDO::PARAM_STR);
      $requeteDeleteSelection->execute();
      header("location: ../pages.php?access=$url&pages=view&display=comptabilite");
      break;

    case 'auth_confirm':
      $requeteConfirm = $baseDeDonnee->prepare('SELECT * FROM users WHERE id_users=:id_users ');
      $requeteConfirm->bindValue(':id_users', $_SESSION['id_users'], PDO::PARAM_INT);
      $requeteConfirm->execute();
      $data = $requeteConfirm->fetch();
      if (password_verify($_POST['auth_confirm'], $data['auth_confirm'])) {
        $_SESSION['chmod'] = $data['auth_confirm'];
        $_SESSION['url'] = $_POST['url_page'];
        header("Location: ../pages.php?access=$url&pages=view&display=attente_confirm");
      } else {
        header("Location: ../pages.php?access=$url&pages=view&display=attente_confirm");
        $_SESSION['flash']['danger'] = "Passcode incorrecte";
      }
      break;

    case 'update_pin':
      $auth_confirm = password_hash($_POST['auth_confirm'], PASSWORD_BCRYPT);
      $requete = $baseDeDonnee->prepare('UPDATE users SET auth_confirm=:auth_confirm WHERE id_users=:id_users ');
      $requete->bindValue(':auth_confirm', $auth_confirm, PDO::PARAM_STR);
      $requete->bindValue(':id_users', $_SESSION['id_users'], PDO::PARAM_INT);
      $requete->execute();
      header("location: ../pages.php?access=$url&pages=view&display=user_profile");
      $_SESSION['flash']['success'] = "Changement Effectué";
      break;

    case 'confirm_paiement':
      $requeteConfirm = $baseDeDonnee->prepare('UPDATE  payements SET  confirm_at = NOW(), confirm_id =:confirm_id  WHERE id_payements=:id_payements');
      $requeteConfirm->bindValue(':confirm_id', $_SESSION['id_users'], PDO::PARAM_INT);
      $requeteConfirm->bindValue(':id_payements', $_GET['id_payements'], PDO::PARAM_INT);
      $requeteConfirm->execute();
      header("location: ../pages.php?access=$url&pages=view&display=attente_confirm");
      $_SESSION['flash']['success'] = "Opération   Effectuée";
      break;

    case 'reset_operation':
      if (!empty($_POST['reset_message'])) {
        $requeteReset = $baseDeDonnee->prepare('UPDATE  payements SET  reset_at = NOW(), reset_id =:reset_id  WHERE id_payements =:id_payements');
        $requeteReset->bindValue(':reset_id', $_SESSION['id_users'], PDO::PARAM_INT);
        $requeteReset->bindValue(':id_payements', $_POST['id_payements'], PDO::PARAM_INT);
        $requeteReset->execute();
        $query = $baseDeDonnee->prepare('INSERT INTO notifications(reset_id,id_espaces,reset_message) VALUES(:reset_id,:id_espaces,:reset_message)');
        $query->bindValue(':reset_id', $_SESSION['id_users'], PDO::PARAM_INT);
        $query->bindValue(':id_espaces', $_POST['id_espaces'], PDO::PARAM_INT);
        $query->bindValue(':reset_message', $_POST['reset_message'], PDO::PARAM_STR);
        $query->execute();
        header("location: ../pages.php?access=$url&pages=view&display=attente_confirm");
        $_SESSION['flash']['success'] = "Opération non  Effectuée";
      } else {
        header("location: ../pages.php?access=$url&pages=view&display=attente_confirm");
        $_SESSION['flash']['success'] = "Opération non  Effectuée";
      }
      break;

    case 'paiement_location':
      if (!empty($_POST['id_espaces']) && !empty($_POST['id_mois']) && !empty($_POST['annee'])  && !empty($_POST['montant']) && !empty($_POST['montant_recu']) && !empty($_POST['date_recu'])) {
        $requetepaiement = $baseDeDonnee->prepare('SELECT * FROM payements WHERE (id_clients_espaces=:id_espaces) AND (montant_recu=:montant_recu) AND (id_mois=:id_mois AND annee=:annee) AND (reset_at IS NULL) ');
        $requetepaiement->bindValue(':id_espaces', $_POST['id_espaces'], PDO::PARAM_INT);
        $requetepaiement->bindValue(':montant_recu', $_POST['montant_recu'], PDO::PARAM_INT);
        $requetepaiement->bindValue(':id_mois', $_POST['id_mois'], PDO::PARAM_INT);
        $requetepaiement->bindValue(':annee', $_POST['annee'], PDO::PARAM_INT);
        $requetepaiement->execute();
        $displaypaiement = $requetepaiement->fetch();
        if ($_POST['annee'] == $displaypaiement['annee'] && $_POST['id_mois'] == $displaypaiement['id_mois'] && $_POST['montant_recu'] == $displaypaiement['montant_recu']) {
          header("location: ../pages.php?access=$url&pages=view&display=location_paiement");
          $_SESSION['flash']['danger'] = "Ce client a déjà payé ce mois, Merci de bien vouloir le  vérifier dans les opérations";
        } else {

          $getLocation = $baseDeDonnee->prepare("SELECT * FROM location WHERE id_espaces=:id_espaces");
          $getLocation->bindValue(':id_espaces', $_POST['id_espaces'], PDO::PARAM_STR);
          $getLocation->execute();
          $getData = $getLocation->fetch();
          $query = $baseDeDonnee->prepare('INSERT INTO payements (id_clients_espaces,id_mois,montant,montant_recu,agent_insert,annee,date_recu,clients) VALUES(:id_espaces,:id_mois,:montant,:montant_recu,:agent_insert,:annee,:date_recu,:clients)');
          $query->bindValue(':id_espaces', $_POST['id_espaces'],  PDO::PARAM_INT);
          $query->bindValue(':id_mois', $_POST['id_mois'],  PDO::PARAM_INT);
          $query->bindValue(':montant', $_POST['montant'],  PDO::PARAM_INT);
          $query->bindValue(':montant_recu', $_POST['montant_recu'],  PDO::PARAM_STR);
          $query->bindValue('agent_insert', $_SESSION['id_users'], PDO::PARAM_INT);
          $query->bindValue('annee', $_POST['annee'], PDO::PARAM_INT);
          $query->bindValue('date_recu', $_POST['date_recu'], PDO::PARAM_STR);
          $query->bindValue('clients', $getData['id_clients'], PDO::PARAM_INT);
          $query->execute();
          header("location: ../pages.php?access=$url&pages=view&display=location_paiement");
          $_SESSION['flash']['success'] = "Paiement Effectuée";
        }
      } else {
        header("location: ../pages.php?access=$url&pages=view&display=location_paiement ");
        $_SESSION['flash']['danger'] = "Paiement non Effectuée";
      }
      break;

    case 'check_password':
      if (!empty($_POST['password'])) {
        $query = $baseDeDonnee->prepare("SELECT * FROM users WHERE id_users=:id_users ");
        $query->bindValue(':id_users', $_SESSION['id_users'], PDO::PARAM_INT);
        $query->execute();
        $data = $query->fetch();
        if (password_verify($_POST['password'], $data['password'])) {
          header("location: ../pages.php?access=$url&pages=profile&display=second");
        } else {
          header("location: ../pages.php?access=$url&pages=profile&display=first");
        }
      }
      break;
    case 'update_password':
      $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
      $user_id = $_SESSION['id_users'];
      $query = $baseDeDonnee->prepare('UPDATE users SET password = ? WHERE id_users = ?')->execute([$password, $user_id]);
      header("location: ../pages.php?access=$url&pages=view&display=user_profile");
      $_SESSION['flash']['success'] = "Changement Effectué";
      break;

    case 'add_users':
      if (!empty($_POST['login']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['password']) && !empty($_POST['status'])) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $requeteUsers = $baseDeDonnee->prepare("INSERT INTO users(login,nom,prenom,password,status) VALUES(:login,:nom,:prenom,:password,:status)");
        $requeteUsers->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
        $requeteUsers->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
        $requeteUsers->bindValue(':prenom', $_POST['prenom'], PDO::PARAM_STR);
        $requeteUsers->bindValue(':password', $password, PDO::PARAM_STR);
        $requeteUsers->bindValue(':status', $_POST['status'], PDO::PARAM_STR);
        $requeteUsers->execute();
        header("location: ../pages.php?access=$url&pages=view&display=listes_users");
        $_SESSION['flash']['success'] = "Changement Effectué";
      } else {
        header("location: ../pages.php?access=$url&pages=view&display=listes_users");
        $_SESSION['flash']['danger'] = "Action non Effectuée";
      }

      break;

    case 'update_users':
      if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $auth_confirm = password_hash($_POST['auth_confirm'], PASSWORD_BCRYPT);
        $requeteUsers = $baseDeDonnee->prepare("UPDATE users SET login=:login,nom=:nom,prenom=:prenom,password=:password,status=:status,auth_confirm=:auth_confirm WHERE id_users=:id_users");
        $requeteUsers->bindValue(':id_users', $_POST['id_users'], PDO::PARAM_INT);
        $requeteUsers->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
        $requeteUsers->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
        $requeteUsers->bindValue(':prenom', $_POST['prenom'], PDO::PARAM_STR);
        $requeteUsers->bindValue(':password', $password, PDO::PARAM_STR);
        $requeteUsers->bindValue(':status', $_POST['status'], PDO::PARAM_STR);
        $requeteUsers->bindValue(':auth_confirm', $auth_confirm, PDO::PARAM_STR);
        $requeteUsers->execute();
      } else {
        $auth_confirm = password_hash($_POST['auth_confirm'], PASSWORD_BCRYPT);
        $requeteUsers = $baseDeDonnee->prepare("UPDATE users SET login=:login,nom=:nom,prenom=:prenom,status=:status,auth_confirm=:auth_confirm WHERE id_users=:id_users");
        $requeteUsers->bindValue(':id_users', $_POST['id_users'], PDO::PARAM_INT);
        $requeteUsers->bindValue(':login', $_POST['login'], PDO::PARAM_STR);
        $requeteUsers->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
        $requeteUsers->bindValue(':prenom', $_POST['prenom'], PDO::PARAM_STR);
        $requeteUsers->bindValue(':status', $_POST['status'], PDO::PARAM_STR);
        $requeteUsers->bindValue(':auth_confirm', $auth_confirm, PDO::PARAM_STR);
        $requeteUsers->execute();
      }
      header("location: ../pages.php?access=$url&pages=view&display=listes_users");
      $_SESSION['flash']['success'] = "Changement Effectué";
      break;
    case 'delete_users':
      $requeteDelete = $baseDeDonnee->prepare('DELETE FROM users WHERE id_users=:id_users');
      $requeteDelete->bindValue(':id_users', $_GET['id_users'], PDO::PARAM_INT);
      $requeteDelete->execute();
      header("location: ../pages.php?access=$url&pages=view&display=listes_users");
      $_SESSION['flash']['success'] = "Changement Effectué";
      break;


    case 'add_carnet':
      if (!empty($_POST['numero_carnet']) && !empty($_POST['plage1']) && !empty($_POST['plage2']) && !empty($_POST['detenteur'])) {

        $requeteRechercher = $baseDeDonnee->prepare('SELECT * FROM TbleCarnet WHERE NumCarnet=:NumCarnet AND Plage1=:Plage1 AND Plage2=:Plage2');
        $requeteRechercher->bindValue(':NumCarnet', $_POST['numero_carnet'], PDO::PARAM_INT);
        $requeteRechercher->bindValue(':Plage1', $_POST['plage1'], PDO::PARAM_INT);
        $requeteRechercher->bindValue(':Plage2', $_POST['plage2'], PDO::PARAM_INT);
        $requeteRechercher->execute();
        $AfficherResultat = $requeteRechercher->fetch();
        if ($AfficherResultat['NumCarnet'] == $_POST['numero_carnet'] && $AfficherResultat['Plage1'] == $_POST['plage1'] &&  $AfficherResultat['Plage2'] == $_POST['plage2']) {
          header("location: ../pages.php?access=$url&pages=view&display=listes_carnets");
          $_SESSION['flash']['warning'] = "Ce carnet est present dans le systeme ";
        } else {
          $Requete = $baseDeDonnee->prepare('INSERT INTO TbleCarnet(NumCarnet,Plage1,Plage2,Detenteur) VALUES(:NumCarnet,:Plage1,:Plage2,:Detenteur)');
          $Requete->bindValue(':NumCarnet', $_POST['numero_carnet'], PDO::PARAM_INT);
          $Requete->bindValue(':Plage1', $_POST['plage1'], PDO::PARAM_INT);
          $Requete->bindValue(':Plage2', $_POST['plage2'], PDO::PARAM_INT);
          $Requete->bindValue(':Detenteur', $_POST['detenteur'], PDO::PARAM_STR);
          $Requete->execute();
          header("location: ../pages.php?access=$url&pages=view&display=listes_carnets");
          $_SESSION['flash']['success'] = "Changement Effectué";
        }
      }
      break;
  }
}
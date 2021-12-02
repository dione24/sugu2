<?php
require('dbconfig.php');
function logged_only()
{
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  if (!isset($_SESSION['login'])) {
    $_SESSION['flash']['danger'] = " Vous n'avez pas le droit d'acceder a cette page";
    header('location: index.php');
  }
}

function Verify()
{
  if (!isset($_SESSION['url'])  or  $_SESSION['url'] != $_SERVER['REQUEST_URI']) {
    $_SESSION['chmod'] = NULL;
  }
}

function GetEspaceOccupe($baseDeDonnee)
{
  $requeteGetEspaces = $baseDeDonnee->prepare("SELECT * FROM location INNER JOIN espaces ON espaces.id_espaces=location.id_espaces INNER JOIN clients ON clients.id_clients=location.id_clients WHERE location.statut_location=1 AND agent_resiliation IS NULL");
  $requeteGetEspaces->execute();
  $AfficherEspacesOccupee = $requeteGetEspaces->fetchAll();
  return $AfficherEspacesOccupee;
}

function GetEspaceNonOccupe($baseDeDonnee)
{
  $requeteGetEspaces = $baseDeDonnee->prepare("SELECT * FROM espaces WHERE vend_at IS NULL  AND statut_private IS NULL AND id_espaces NOT IN ( SELECT location.id_espaces FROM location INNER JOIN espaces ON espaces.id_espaces=location.id_espaces INNER JOIN clients ON clients.id_clients=location.id_clients)");
  $requeteGetEspaces->execute();
  $AfficherEspacesOccupee = $requeteGetEspaces->fetchAll();
  return $AfficherEspacesOccupee;
}


function GetEspacesVendu($baseDeDonnee)
{
  $requeteEspaceVendu = $baseDeDonnee->prepare("SELECT * FROM  vendre INNER JOIN clients ON clients.id_clients=vendre.id_clients INNER JOIN espaces ON espaces.id_espaces=vendre.id_espaces WHERE espaces.encaissement IS NULL");
  $requeteEspaceVendu->execute();
  $AfficherEspacesVendu = $requeteEspaceVendu->fetchAll();
  return $AfficherEspacesVendu;
}

function GetEspacesVenduEncaissement($baseDeDonnee)
{
  $requeteEspaceVendu = $baseDeDonnee->prepare("SELECT * FROM  vendre INNER JOIN clients ON clients.id_clients=vendre.id_clients INNER JOIN espaces ON espaces.id_espaces=vendre.id_espaces WHERE espaces.encaissement=1");
  $requeteEspaceVendu->execute();
  $AfficherEspacesVendu = $requeteEspaceVendu->fetchAll();
  return $AfficherEspacesVendu;
}

function GetCustomers($baseDeDonnee)
{
  $requeteClients = $baseDeDonnee->prepare("SELECT * FROM clients");
  $requeteClients->execute();
  $AfficherCustomers = $requeteClients->fetchAll();
  return $AfficherCustomers;
}

function UpdateCustomers($baseDeDonnee, $clients)
{
  $UpdateCustomers = $baseDeDonnee->prepare("SELECT * FROM clients WHERE id_clients=:id_clients");
  $UpdateCustomers->bindValue(':id_clients', $clients, PDO::PARAM_INT);
  $UpdateCustomers->execute();
  $AfficherCustomers = $UpdateCustomers->fetch();
  return $AfficherCustomers;
}

function GetResilier($baseDeDonnee)
{
  $ListeResilier = $baseDeDonnee->prepare("SELECT * FROM  resiliation INNER JOIN clients ON clients.id_clients=resiliation.id_clients INNER JOIN espaces ON espaces.id_espaces=resiliation.id_espaces");
  $ListeResilier->execute();
  $AfficherResilier = $ListeResilier->fetchAll();
  return $AfficherResilier;
}

function GetEspaces($baseDeDonnee)
{
  $requeteListesEspaces = $baseDeDonnee->prepare(" SELECT * FROM espaces WHERE vend_at IS NULL AND Delete_id IS NULL  AND statut_private IS NULL ");
  $requeteListesEspaces->execute();
  $AfficherEspaces = $requeteListesEspaces->fetchAll();
  return $AfficherEspaces;
}
function VerifLocation($baseDeDonnee, $espaces)
{
  $UpdateEspaces = $baseDeDonnee->prepare("SELECT * FROM location  WHERE id_espaces=:espaces AND statut_location=1 AND agent_resiliation IS NULL LIMIT 0,1");
  $UpdateEspaces->bindValue(':espaces', $espaces, PDO::PARAM_INT);
  $UpdateEspaces->execute();
  $AfficherEspaces = $UpdateEspaces->fetch();
  return $AfficherEspaces;
}


function UpdateEspaces($baseDeDonnee, $espaces)
{
  $UpdateEspaces = $baseDeDonnee->prepare("SELECT * FROM espaces WHERE id_espaces=:id_espaces");
  $UpdateEspaces->bindValue(':id_espaces', $espaces, PDO::PARAM_INT);
  $UpdateEspaces->execute();
  $AfficherEspaces = $UpdateEspaces->fetch();
  return $AfficherEspaces;
}

function GetPaiements($baseDeDonnee)
{
  $requeteOperations = $baseDeDonnee->prepare(" SELECT *  FROM location LEFT JOIN clients ON clients.id_clients=location.id_clients RIGHT JOIN espaces ON espaces.id_espaces=location.id_espaces LEFT JOIN payements ON payements.id_clients_espaces=location.id_espaces INNER JOIN mois ON mois.id_mois=payements.id_mois WHERE (confirm_at IS NOT NULL AND reset_id IS NULL)");
  $requeteOperations->execute();
  $AfficherOperations = $requeteOperations->fetchAll();
  return $AfficherOperations;
}

function GetConfirmList($baseDeDonnee)
{
  $requeteConfirm = $baseDeDonnee->prepare("SELECT *  FROM payements INNER JOIN espaces ON espaces.id_espaces=payements.id_clients_espaces INNER JOIN mois ON mois.id_mois=payements.id_mois INNER JOIN location ON location.id_espaces=payements.id_clients_espaces INNER JOIN clients ON clients.id_clients=location.id_clients  WHERE (confirm_at IS NULL AND reset_id IS NULL) ");
  $requeteConfirm->execute();
  $AfficherConfirm = $requeteConfirm->fetchAll();
  return $AfficherConfirm;
}

function GetConfirmListVendu($baseDeDonnee)
{
  $requeteConfirm = $baseDeDonnee->prepare("SELECT * FROM payements INNER JOIN espaces ON espaces.id_espaces=payements.id_clients_espaces INNER JOIN mois ON mois.id_mois=payements.id_mois INNER JOIN location ON location.id_espaces=payements.id_clients_espaces INNER JOIN clients ON clients.id_clients=location.id_clients  WHERE (confirm_at IS NULL AND reset_id IS NULL) ");
  $requeteConfirm->execute();
  $AfficherConfirm = $requeteConfirm->fetchAll();
  return $AfficherConfirm;
}
function GetMonth($baseDeDonnee)
{
  $requeteMois = $baseDeDonnee->prepare('SELECT * FROM mois');
  $requeteMois->execute();
  $AfficherMois = $requeteMois->fetchAll();
  return $AfficherMois;
}

function GetPaiementsPeriode($baseDeDonnee, $date1, $date2)
{
  $requeteOperations = $baseDeDonnee->prepare("SELECT *  FROM location LEFT JOIN clients ON clients.id_clients=location.id_clients RIGHT JOIN espaces ON espaces.id_espaces=location.id_espaces LEFT JOIN payements ON payements.id_clients_espaces=location.id_espaces INNER JOIN mois ON mois.id_mois=payements.id_mois WHERE payements.date_recu BETWEEN '$date1' AND '$date2' AND (confirm_at IS NOT NULL AND reset_id IS NULL)  AND espaces.Delete_id IS NULL ");
  $requeteOperations->execute();
  $AfficherOperations = $requeteOperations->fetchAll();
  return $AfficherOperations;
}

function RequetePaiement($baseDeDonnee, $mois1, $mois2, $year)
{
  $requeteOperations = $baseDeDonnee->prepare("SELECT *  FROM location LEFT JOIN clients ON clients.id_clients=location.id_clients RIGHT JOIN espaces ON espaces.id_espaces=location.id_espaces LEFT JOIN payements ON payements.id_clients_espaces=location.id_espaces INNER JOIN mois ON mois.id_mois=payements.id_mois WHERE payements.id_mois BETWEEN '$mois1' AND '$mois2' AND (confirm_at IS NOT NULL AND reset_id IS NULL) AND payements.annee=\"$year\" AND espaces.Delete_id IS NULL");
  $requeteOperations->execute();
  $AfficherOperations = $requeteOperations->fetchAll();
  return $AfficherOperations;
}






function GetImpaye($baseDeDonnee, $mois, $annee)
{
  $requeteImpaye = $baseDeDonnee->prepare(" SELECT * FROM location INNER JOIN clients ON location.id_clients=clients.id_clients INNER JOIN espaces ON espaces.id_espaces=location.id_espaces WHERE location.id_espaces NOT IN (SELECT id_clients_espaces FROM payements WHERE payements.id_mois=\"$mois\"  AND payements.annee=\"$annee\" AND (confirm_at IS NOT NULL AND reset_id IS NULL) ) AND espaces.Delete_id IS NULL ");
  $requeteImpaye->execute();
  $AffcherImpaye = $requeteImpaye->fetchAll();
  return $AffcherImpaye;
}
function GETUsers($baseDeDonnee)
{
  $requeteUsers = $baseDeDonnee->prepare('SELECT * FROM users');
  $requeteUsers->execute();
  $AfficherUsers = $requeteUsers->fetchAll();
  return $AfficherUsers;
}
function SingleUser($baseDeDonnee, $users)
{
  $requeteUsers = $baseDeDonnee->prepare('SELECT * FROM users WHERE id_users=:id_users');
  $requeteUsers->bindValue(':id_users', $users, PDO::PARAM_INT);
  $requeteUsers->execute();
  $AfficherUsers = $requeteUsers->fetch();
  return $AfficherUsers;
}
function GetMessages($baseDeDonnee)
{
  $requeteMessages = $baseDeDonnee->prepare("SELECT  * FROM notifications INNER JOIN espaces ON espaces.id_espaces=notifications.id_espaces WHERE DATE(date_notification)= CAST(NOW() AS DATE)");
  $requeteMessages->execute();
  $AfficherMessages = $requeteMessages->fetchAll();
  return $AfficherMessages;
}
function CountMessages($baseDeDonnee)
{
  $requeteMessages = $baseDeDonnee->prepare("SELECT COUNT(id_not) FROM notifications  WHERE DATE(date_notification)= CAST(NOW() AS DATE)");
  $requeteMessages->execute();
  $Resulat = $requeteMessages->fetchAll();
  return $Resulat[0][0];
}
function GetMessagesAll($baseDeDonnee)
{
  $requeteMessages = $baseDeDonnee->prepare("SELECT  * FROM notifications INNER JOIN espaces ON espaces.id_espaces=notifications.id_espaces ");
  $requeteMessages->execute();
  $AfficherMessages = $requeteMessages->fetchAll();
  return $AfficherMessages;
}

function CountClient($baseDeDonnee)
{
  $requeteCount = $baseDeDonnee->prepare(' SELECT COUNT(id_clients) AS  Nbclient FROM clients');
  $requeteCount->execute();
  $Afficher = $requeteCount->fetch();
  return $Afficher['Nbclient'];
}
function CountEspaces($baseDeDonnee)
{
  $requeteCount = $baseDeDonnee->prepare('SELECT COUNT(espaces.id_espaces) AS NbEspaces  FROM clients INNER JOIN location ON clients.id_clients=location.id_clients RIGHT JOIN espaces ON location.id_espaces=espaces.id_espaces WHERE vend_at IS NULL  AND statut_private IS NULL');
  $requeteCount->execute();
  $Afficher = $requeteCount->fetch();
  return $Afficher['NbEspaces'];
}
function CountLocation($baseDeDonnee)
{
  $requeteCount = $baseDeDonnee->prepare(' SELECT COUNT(id_espaces) AS NbLocation FROM location WHERE statut_location=1 AND agent_resiliation IS NULL');
  $requeteCount->execute();
  $Afficher = $requeteCount->fetch();
  return $Afficher['NbLocation'];
}
function CountImpaye($baseDeDonnee, $mois, $date)
{
  $date = date('m');
  $mois = intval($date);
  $annee = date('Y');
  $requeteImpaye = $baseDeDonnee->prepare("SELECT COUNT(location.id_espaces) AS Impaye FROM location INNER JOIN clients ON location.id_clients=clients.id_clients INNER JOIN espaces ON espaces.id_espaces=location.id_espaces WHERE location.id_espaces NOT IN (SELECT id_clients_espaces FROM payements WHERE payements.id_mois=:mois AND payements.annee=:annee AND (confirm_at IS NOT NULL AND reset_id IS NULL) ) ");
  $requeteImpaye->bindValue(':mois', $mois, PDO::PARAM_INT);
  $requeteImpaye->bindValue(':annee', $annee, PDO::PARAM_INT);
  $requeteImpaye->execute();
  $AffcherImpaye = $requeteImpaye->fetch();
  return $AffcherImpaye['Impaye'];
}
function MontantMonth($baseDeDonnee)
{
  $month = date('m');
  $operations = $baseDeDonnee->prepare("SELECT SUM(montant) AS MontantTotal FROM location LEFT JOIN clients ON clients.id_clients=location.id_clients RIGHT JOIN espaces ON espaces.id_espaces=location.id_espaces LEFT JOIN payements ON payements.id_clients_espaces=location.id_espaces INNER JOIN mois ON mois.id_mois=payements.id_mois WHERE MONTH(payements.date_recu)=:mois AND YEAR(payements.date_recu)=:year AND (confirm_at IS NOT NULL AND reset_id IS NULL) ");
  $operations->bindValue(':mois', date('m'), PDO::PARAM_STR);
  $operations->bindValue(':year', date('Y'), PDO::PARAM_STR);
  $operations->execute();
  $display_operations = $operations->fetch();
  return $display_operations['MontantTotal'];
}
function getCurrentWeek()
{
  $monday = strtotime("last monday");
  $monday = date('w', $monday) == date('w') ? $monday + 7 * 86400 : $monday;
  $sunday = strtotime(date("Y-m-d", $monday) . " +6 days");
  $date['Debut']  = date("Y-m-d", $monday);
  $date['Fin'] = date("Y-m-d", $sunday);
  return $date;
}
function MontantWeek($baseDeDonnee)
{
  $getCurrentWeek = getCurrentWeek();
  $date1 = $getCurrentWeek['Debut'];
  $date2 = $getCurrentWeek['Fin'];
  $operations = $baseDeDonnee->prepare("SELECT SUM(montant) AS MontantTotal FROM location LEFT JOIN clients ON clients.id_clients=location.id_clients RIGHT JOIN espaces ON espaces.id_espaces=location.id_espaces LEFT JOIN payements ON payements.id_clients_espaces=location.id_espaces INNER JOIN mois ON mois.id_mois=payements.id_mois WHERE payements.date_recu BETWEEN '$date1' AND '$date2' AND (confirm_at IS NOT NULL AND reset_id IS NULL)");
  $operations->execute();
  $display_operations = $operations->fetch();
  return $display_operations['MontantTotal'];
}
function ReplyNOTIF($baseDeDonnee, $messages)
{
  $requete = $baseDeDonnee->prepare('UPDATE notifications SET status = 1 WHERE id_not=:id_not');
  $requete->bindValue(':id_not', $messages, PDO::PARAM_INT);
  $requete->execute();
}

function NonConfirm($baseDeDonnee)
{
  $requeteOperations = $baseDeDonnee->prepare(" SELECT SUM(montant) AS MontantTotal FROM location LEFT JOIN clients ON clients.id_clients=location.id_clients RIGHT JOIN espaces ON espaces.id_espaces=location.id_espaces LEFT JOIN payements ON payements.id_clients_espaces=location.id_espaces INNER JOIN mois ON mois.id_mois=payements.id_mois WHERE (confirm_at IS NULL AND reset_id IS NULL) ");
  $requeteOperations->execute();
  $AfficherOperations = $requeteOperations->fetch();
  return $AfficherOperations['MontantTotal'];
}

function GetCarnet($baseDeDonnee)
{
  $requete = $baseDeDonnee->prepare('SELECT * FROM TbleCarnet');
  $requete->execute();
  $Afficher = $requete->fetchAll();
  return $Afficher;
}

function VerifyRecu($baseDeDonnee, $recu)
{
  $requeteRecu = $baseDeDonnee->prepare("SELECT  montant_recu FROM payements WHERE payements.montant_recu=:recu AND (confirm_at IS NOT NULL AND reset_id IS NULL) ");
  $requeteRecu->bindValue(':recu', $recu, PDO::PARAM_INT);
  $requeteRecu->execute();
  $AfficheRecu = $requeteRecu->fetch();
  return $AfficheRecu['montant_recu'];
}
function ImpayeLocation($baseDeDonnee, $espaces, $Year = NULL)
{
  if (empty($Year)) {
    $Year = date('Y');
  }
  $requete = $baseDeDonnee->prepare(" SELECT id_mois AS ID,nom_mois,(SELECT montant FROM payements WHERE payements.id_mois=ID  AND payements.id_clients_espaces=:espaces AND annee=:year AND confirm_id IS NOT NULL AND reset_id IS NULL LIMIT 1) AS DATA FROM mois ");
  $requete->bindValue(':espaces', $espaces, PDO::PARAM_INT);
  $requete->bindValue(':year', $Year, PDO::PARAM_STR);
  $requete->execute();
  $Afficher = $requete->fetchAll();
  return $Afficher;
}

function GetPaiementsEspaces($baseDeDonnee, $espaces)
{
  $requeteRecu = $baseDeDonnee->prepare("SELECT * FROM payements WHERE date_payement=(SELECT MAX(date_payement) FROM payements WHERE payements.id_clients_espaces=:espaces AND payements.confirm_id IS NOT NULL AND payements.reset_id IS NULL)");
  $requeteRecu->bindValue(':espaces', $espaces, PDO::PARAM_INT);
  $requeteRecu->execute();
  $AfficheRecu = $requeteRecu->fetch();
  return $AfficheRecu['montant'];
}
function ListePaiementEspaces($baseDeDonnee, $espaces)
{
  $requete = $baseDeDonnee->prepare(" SELECT * FROM payements INNER JOIN mois ON mois.id_mois=payements.id_mois  WHERE payements.id_clients_espaces=:espaces AND payements.confirm_id IS NOT NULL AND payements.reset_id IS NULL ");
  $requete->bindValue(':espaces', $espaces, PDO::PARAM_INT);
  $requete->execute();
  $Result = $requete->fetchAll();
  return $Result;
}
function AncienLocataires($baseDeDonnee, $espaces)
{
  $requete = $baseDeDonnee->prepare("SELECT * FROM location INNER JOIN clients ON clients.id_clients=location.id_clients WHERE location.id_espaces=:espaces AND statut_location=3 AND agent_resiliation IS NOT NULL");
  $requete->bindValue(':espaces', $espaces, PDO::PARAM_INT);
  $requete->execute();
  $Result = $requete->fetchAll();
  return $Result;
}



function getPrivatePaiements($baseDeDonnee)
{
  $requeteOperations = $baseDeDonnee->prepare("SELECT * FROM paymentsprivate INNER JOIN privatelocation ON privatelocation.RefLocation=paymentsprivate.RefLocation INNER JOIN mois ON mois.id_mois=paymentsprivate.mois INNER JOIN annee ON annee.RefYear=paymentsprivate.annee INNER JOIN clients ON clients.id_clients=privatelocation.RefClients INNER JOIN espaces ON espaces.id_espaces=privatelocation.RefEspaces  ");
  $requeteOperations->execute();
  $AfficherOperations = $requeteOperations->fetchAll();
  return $AfficherOperations;
}

function GetConfirmListPrivate($baseDeDonnee)
{
  $requeteConfirm = $baseDeDonnee->prepare("SELECT *  FROM payements INNER JOIN espaces ON espaces.id_espaces=payements.id_clients_espaces INNER JOIN mois ON mois.id_mois=payements.id_mois INNER JOIN location ON location.id_espaces=payements.id_clients_espaces INNER JOIN clients ON clients.id_clients=location.id_clients  WHERE (confirm_at IS NULL AND reset_id IS NULL) ");
  $requeteConfirm->execute();
  $AfficherConfirm = $requeteConfirm->fetchAll();
  return $AfficherConfirm;
}
function PrivateLocation($baseDeDonnee)
{
  $requete = $baseDeDonnee->prepare("SELECT * FROM privatelocation INNER JOIN clients ON clients.id_clients=privatelocation.RefClients INNER JOIN espaces ON espaces.id_espaces=privatelocation.RefEspaces WHERE privatelocation.statut_location=1");
  $requete->execute();
  $Result = $requete->fetchAll();
  return $Result;
}

function GetYear($baseDeDonnee)
{
  $requeteMois = $baseDeDonnee->prepare('SELECT * FROM annee');
  $requeteMois->execute();
  $AfficherMois = $requeteMois->fetchAll();
  return $AfficherMois;
}

function GetTypeEsapces($baseDeDonnee)
{
  $requeteMois = $baseDeDonnee->prepare('SELECT * FROM type_espaces');
  $requeteMois->execute();
  $AfficherMois = $requeteMois->fetchAll();
  return $AfficherMois;
}

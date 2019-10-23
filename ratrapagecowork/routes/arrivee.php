<?php
session_start();
require('../bdd.php');
require('../model/client.php');
require('../model/abonnement.php');
require('../model/extra.php');
require('../model/statut.php');
$id_site =$_SESSION['site'];
$timed = date('Y-m-d H:i:s') ;
$id = $_POST['id'];
if($id_site == null || $id == null)return ;
$client = new CLIENT();
$client->id = $id;
$client = selectById($client);

$abonnement = new ABONNEMENT();
$abo = selectWithCondition($abonnement , "id_client = ".$id." AND id_site = ".$id_site);
if(!empty($abo))$abonnement = $abo[0];
else $abonnement->id_extra = 1;

$timed = date_create($timed);
$timea = date_create($client->arrivee);
$interval = date_diff($timea,$timed);
$heure = $interval->format('%h');
$jour = $interval->format('%a');
if($jour > 0)$dette = $extra->max;
$extra = new EXTRA();
$extra->id = $abonnement->id_extra;
$extra = selectById($extra);
$dette = $extra->tarif_base;
$temps=$heure - $extra->temps_base;
if($temps > 0 && $extra->temps_sup != 0){
  $temps = $temps/$extra->temps_sup;
  $dette += $temps * $extra->tarif_sup;
}
if($dette > $extra->max) $dette = $extra->max;
$client->dette += $dette;
$client->depart = $timed->format('Y-m-d H:i:s');
update($client);
echo json_encode($client);
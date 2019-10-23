<?php
session_start();
require('../bdd.php');
require('../model/client.php');
require('../model/clientabo.php');
require('../model/objectreservable.php');
require('../model/abonnement.php');
require('../model/statut.php');
$id_site = $_SESSION['site'];
$users = array();
$clients = new CLIENT();
$clients = selectWithCondition($clients,"1");
foreach($clients as $client){
    $abo = new ABONNEMENT();
    $statut = new STATUT();
    $abo = selectWithCondition($abo," id_client = ".$client->id." AND id_site =".$id_site . " AND date_fin > NOW()");
   
    if(!empty($abo)){
        $abo = $abo[0];
        $statut->id = $abo->id_statut;
        $statut = selectById($statut);
    
    }
  	$obj = new OBJECT_RESERVABLE();
  	$obj = selectWithCondition($obj,"client_possession = ".$client->id);
    $user = new Clientabo();
    $user->client = $client;
    $user->abo = $statut;
  if(!empty($obj))$user->object = $obj;
    $users[] = $user;
}
echo json_encode($users);
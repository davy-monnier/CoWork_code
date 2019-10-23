<?php

session_start();
require('../model/objectreservable.php');
require('../model/objectadmin.php');
require('../model/client.php');
require('../model/reservation.php');
require('../bdd.php');

$id_site = $_SESSION['site'];
if($id_site == null)return "error";

$obj = new OBJECT_RESERVABLE();
$tabretour = array();
if($_POST['id'] =! null && !empty($_POST['id']) ){
    $obj = selectWithCondition($obj , "supervise = 1 AND id_client = ".$_POST['id']." AND id_site = ".$id_site);
}else{
    $obj = selectWithCondition($obj , "supervise >= 0 AND quantite >= 0 AND id_site = ".$id_site);
}
foreach($obj as $objet){
    $objad = new ObjectAdmin();
    if($objet->client_possession != -1){
       
        $client = new CLIENT();
        $client->id = $objet->client_possession ; 
        $objad->client = selectById($client);
            
    }else{
        $client = new CLIENT();
        $client->id = -1; 
        $client->nom = "En stock.";
        
        $objad->client = $client;
    }
    $objad->obj = $objet;
  
  	$reservation = new RESERVATION();
  	$reservation = selectWithCondition($reservation,"id_object = ".$objad->obj->id. " AND date_debut < NOW() AND date_fin > NOW()");
  	
  if(!empty($reservation) ){
    $client = new CLIENT();
    $client->id = $reservation[0]->id_client ; 
    $objad->client_reserv = selectById($client);
  }else  $objad->client_reserv = null;
  
    $tabretour[]= $objad;
}
echo json_encode($tabretour);
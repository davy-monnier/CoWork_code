<?php

session_start();
require('../model/objectreservable.php');
require('../model/objectadmin.php');
require('../model/client.php');
require('../model/reservation.php');
require('../bdd.php');

$id_site = $_SESSION['site'];
//$id_site = 2;
if($id_site == null){echo "error session";return;}

$obj = new OBJECT_RESERVABLE();
$reservations = new RESERVATION();
$tabretour = array();
$tabreserv = array();
$tabquant = array();

//recuperer tous les objets commandables 
$obj =selectWithCondition($obj,"quantite = -1 AND id_site =".$id_site);
$condition = "";
$i = 0;
foreach($obj as $objet){
 if($i++ == 0){
   $condition .= "id_object = ".$objet->id;
 }else $condition .= " OR id_object = ".$objet->id;  
}
$condition = "(".$condition.") AND date_debut > NOW() ORDER BY date_debut DESC";


//recuperation de toutes les reservations dont l'objet est un objet a commander
$reservations = selectWithCondition($reservations,$condition);
$tampon;
$i=0;

//regroupe par date et calcul la quantité
foreach($reservations as $reservation){
  
  if($tampon == null ){
    $reservation->quantite;
    $tabreserv[$i] = $reservation;
    $tabquant[$i] = 1;
    $tampon = $reservation;
  }else{
    if($tampon->date_debut == $reservation->date_debut){
    	$tabquant[$i] += 1;
      	if($reservation->retour == null)$tabreserv[$i-1]->retour = null;
    }else{
      $i++;
      $tabreserv[$i] = $reservation;
      $tabquant[$i] = 1;
      $tampon = $reservation;
    }
  }
}



//retourne l'obet de chaque reservation avec pour quantité le nombre de reservations 
$i=0;
foreach($tabreserv as $reserv){
      	$objectResever = new OBJECT_RESERVABLE();
     	$objectResever->id = $reserv->id_object;
      	$objectResever = selectById($objectResever);
        $objectResever->quantite = $tabquant[$i++];
  		$objectResever->date = $reserv->date_debut;
        if($reserv->retour != null){
        	$objectResever->supervise = $reserv->retour;
        }
        $tabretour[]= $objectResever;
        
      	
    }


echo json_encode($tabretour);
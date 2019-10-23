<?php
session_start();
require('../model/reservation.php');
require('../model/client.php');
require('../model/objectreservable.php');
require('email.php');
require('../bdd.php');

if( !isset($_POST['id_object']) && !isset($_POST['id_client']) && !isset($_POST['date_debut'])  && !isset($_POST['date_fin'])){
    
    echo "toute les variable ne sont pas instancié";
    return;
}
if(empty($_POST['id_object']) && empty($_POST['id_client']) && empty($_POST['date_debut']) && empty($_POST['date_fin'])){
    
    echo "des variable sont vide";
    return;
} 

$reservation = new RESERVATION();
$reservation->id_object  = $_POST['id_object'];
$reservation->id_client  = $_POST['id_client'];
$reservation->date_reservation = date("Y-m-d H:i:s");
$reservation->date_debut = $_POST['date_debut'];
$reservation->date_fin   = $_POST['date_fin'];

if(isset($_POST['retour']) && !empty($_POST['retour']))
    $reservation->retour   = $_POST['retour'];
//insert($reservation);
$objet = new OBJECT_RESERVABLE();
$objet->id = $_POST['id_object'];
$objet = selectById($objet);
if($objet->quantite == -1){
  	$datedebuttamp = explode("",$reservation->date_debut);
	$reservation->date_debut= $datedebuttamp[0]." 12:00";
	$datedebut = date_create($reservation->date_debut);
	$datefin = date_create($reservation->date_fin);
	$interval = date_diff($datedebut,$datefin);
	$jour = $interval->format('%a');
    echo "jou = ". $jour." ! ";
	for($i = 0 ; $i <= $jour ; $i++){
    	echo $i ." / ";
      	$datedebut = date_create($reservation->date_debut);
      	if($i == 0) $ind = 0;
      	else $ind = 1;
  		$newdate = date_add($datedebut, date_interval_create_from_date_string($ind.' days'))->format("Y-m-d H:i:s");
        echo $newdate." & ";
  		$reservation->date_debut = $newdate;
  		$reservation->date_fin = $newdate;
  		insert($reservation);
	}
}else insert($reservation);
//date_add($date, date_interval_create_from_date_string('10 days'));
$client = new CLIENT();
$client->id = $_POST['id_client'];
$client = selectById($client);
$message ="Bonjour ".$client->nom." ".$client->prenom."
   Nous confirmons votre résèvation de '".$objet->nom."' du ".$reservation->date_debut." au ".$reservation->date_fin.".
  Celle ci apparaîtra dans votre calendrier. 
  L'équipe CoWork vous remercie d'utiliser nos services.
  Nous vous souhaitons une bonne journée.
  L'équipe CoWork.
  
  PS:
 Si vous n'êtes pas à l'origine veuillez annuler la réservation dans votre calendrier et créer un ticket incident s'il vous plait.
 De plus nous vous conseillons de changer votre mot de passe." ;
sendEmail("",$client->email,"Reservation",$message);

echo "ok";



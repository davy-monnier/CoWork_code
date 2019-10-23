
<?php 
session_start();

require('../model/reservation.php');
require('../model/client.php');
require('../bdd.php');

/*
$id_obj = $_POST['id_obj'];
$date = $_POST['date'];*/

$id_obj = 43;
$date = "2019-10-22 12:00:00";
$tabretour = array();
//recuperation des Reservations vi id_objet et date
$reservation = new RESERVATION();
$reservations = selectWithCondition($reservation , " date_debut = ".type($date)." AND id_object =".$id_obj);

echo "id_site = ".$site." AND date_debut = ".type($date)." AND id_object =".$id_obj;
//pour chaque reservation recuperer le client 
//associer la valeur de retour au client

foreach($reservations as $res){
    $client = new CLIENT();
    $client->id = $res->id_client;
    $client = selectById($client);
    $client->password = "".$res->retour;
    $tabretour [] = $client; 
}

echo json_encode($tabretour);


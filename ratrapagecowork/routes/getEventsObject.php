<?php
session_start();
require('../bdd.php');
require('../model/reservation.php');
require('../model/client.php');
require('../model/event.php');
require('../model/objectreservable.php');
$id = $_POST['id'];

function echoEvent($reserv ){
    $obj = new OBJECT_RESERVABLE();
    $client = new CLIENT();
    
    $obj->id = $reserv->id_object;
    $client->id = $reserv->id_client;
    
    $client = selectById($client);
    $obj = selectById($obj);
    
  	$event = new Event();
  	$event->id = $reserv->id;
  	$event->title = $client->nom." ".$client->nom." ".$client->email;
  	$event->start = $reserv->date_debut;
  	$event->end = $reserv->date_fin;
  	return $event;
   // echo"{'id' : '".$reserv->id."',title : '".$obj->nom."',start :  '".$reserv->date_debut."',end:  '".$reserv->date_fin."'}";
}

$reservation = new RESERVATION();
$reservation = selectWithCondition($reservation,"id_object = ".$id);
//echo"[";
$i = 0;
$tab = array();
foreach($reservation as $event){
   // if($i++ == 0)echoEvent($event);
    //else {
        //echo ",";
  
       $tab[] = echoEvent($event,$tab);
    //}
}
//echo"]";

//$element2 = {title:"test2",start:"2019-09-15"};

//$tab['title']= "test";
//$tab['start'] ="2019-09-05";
echo json_encode($tab);


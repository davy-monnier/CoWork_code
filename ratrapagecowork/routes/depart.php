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


$timed = date_create($timed);


$client->arrivee = $timed->format('Y-m-d H:i:s');
update($client);
echo json_encode($client);
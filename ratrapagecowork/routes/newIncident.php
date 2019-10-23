<?php
session_start();
require('../model/incident.php');
require('../model/client.php');
require('../bdd.php');

$id_user = $_SESSION['id'];
$id_site = $_SESSION['site'];
$id_admin = -1;
$date = "NOW()";
if( !isset($_POST['id_type_panne'])  || !isset($_POST['description'])){
    
    echo "erreur";
    return;
}

if( empty($_POST['id_type_panne'])  ||  empty($_POST['description'])){
    
    echo "erreur";
    return;
}
$user = new CLIENT();
$user->id = $id_user;
$user = selectById($user);
$incid = new INCIDENT();
$incid->id_user = $id_user;
$incid->id_admin = $id_admin;
$incid->id_type_panne = $_POST['id_type_panne'];
$incid->id_statu_incident = 1;
$incid->date = $date;
$incid->description = $user->nom." ".$user->prenom.": ".$_POST['description'];
$incid->id_site = $id_site;

insert($incid);
echo "ok ";
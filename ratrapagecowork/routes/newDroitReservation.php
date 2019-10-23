<?php
require('../model/droit_reservation.php');
require('../bdd.php');

if( !isset($_POST['id_type']) || !isset($_POST['statut_level']) ){
    
    echo "toute les variable ne sont pas instancié";
    return;
}

if(empty($_POST['id_type']) || empty($_POST['statut_level'])  ){
    
    echo "toute les variable ne sont pas instancié";
    return;
}

$droit 		 		 = new DROIT_RESERVATION();
$droit->prix 		 = $_POST['prix'];
$droit->id_type 	 = $_POST['id_type'];
$droit->statut_level = $_POST['statut_level'];

if(isset( $_POST['prix']) && !empty($_POST['prix']))$droit->prix = $_POST['prix'];
insert($droit);
echo "ok ";
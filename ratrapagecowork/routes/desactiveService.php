<?php
session_start();
require('../model/droit_reservation.php');
require('../bdd.php');
$site = $_SESSION['site'];
$id = $_POST['service'];

if($site == null || $id == null ){
    echo "erreur";
    return;
}
$reserve = new DROIT_RESERVATION();

$reserve = selectwithCondition($reserve , 'id_type ='.$id." AND id_site = ".$site);
$reserve = $reserve[0];
$reserve->statut_level = -1;
update($reserve);
echo "-1";

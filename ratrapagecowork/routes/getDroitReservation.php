<?php

session_start();

$droit = $_SESSION["cowork_statut_level"];
$id_site = $_SESSION["site"];
if($droit == null)return "error";

require('../model/droit_reservation.php');
require('../bdd.php');

$obj= new DROIT_RESERVATION();        
$objretour  = selectWithCondition($obj , "statut_level <= ".$droit." AND statut_level > -1 AND id_site =".$id_site);
echo json_encode($objretour);

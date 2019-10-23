<?php session_start();

require('../model/statut.php');
require('../bdd.php');

$abo = new STATUT();
$abos= selectWithCondition($abo,"1");
echo json_encode($abos);
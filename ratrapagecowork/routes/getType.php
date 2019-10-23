<?php
session_start();
$id_site = $_SESSION['site'];

require('../bdd.php');

$files = glob('../model/*.php');

foreach ($files as $file) {
    require($file); 
  	
}



$droit_abo  = new DROIT_RESERVATION();
$droits      = selectWithCondition($droit_abo , " id_site = ".type($id_site));

$tab;
$i = 0;
foreach($droits as $droit){
    $type = new TYPE();
    $type->id = $droit->id_type; 	
    
    $type = selectById($type);
  	$type->description = $droit->statut_level; 
  	$tab[$i++] =$type;
}

echo json_encode($tab);


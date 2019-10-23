<?php 

require('../model/type.php');
require('../model/droit_reservation.php');
require('../model/site.php');
require('../bdd.php');

if( !isset($_POST['nom']) ||  !isset($_POST['image'])  || !isset($_POST['description'])){
    
    echo "toute les variable ne sont pas instancié";
    return;
}

if( empty($_POST['nom']) || empty($_POST['image']) || empty($_POST['description'])){
    
    echo "toute les variable ne sont pas instancié";
    return;
}

$object = new TYPE();
$object->nom     = $_POST['nom'];

$object->image   = $_POST['image'];
$object->description = $_POST['description'];

insert($object);
$type = selectWithCondition($object, "nom = '".$_POST['nom']."'");
print_r($type);
$type = $type[0];

$sites = new SITE();
$sites = selectWithCondition($sites,"1");
foreach($sites as $site){
	$droit 		 		 = new DROIT_RESERVATION();
	$droit->prix 		 = 0;
	$droit->id_type 	 = $type->id;
	$droit->statut_level = -1;
	$droit->id_site = $site->id;
	if(isset( $_POST['prix']) && !empty($_POST['prix']))$droit->prix = $_POST['prix'];
	insert($droit);
}  
echo "ok";
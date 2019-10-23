<?php
require('../model/objectreservable.php');
require('../bdd.php');
session_start();
if($_SESSION['site'] == null){echo "session" ; return;}
if( !isset($_POST['nom']) || !isset($_POST['id_type']) || !isset($_POST['image'])  || !isset($_POST['description'])){
    
    echo "toute les variable ne sont pas instancié";
    return;
}

if( empty($_POST['nom']) || empty($_POST['id_type'])  || empty($_POST['image']) || empty($_POST['description'])){
    
    echo "toute les variable ne sont pas remplis";
    return;
}

$object = new OBJECT_RESERVABLE();
$object->nom     = $_POST['nom'];
$object->id_type = $_POST['id_type'];
$object->id_site = $_SESSION['site'];
$object->image   = $_POST['image'];
$object->description = $_POST['description'];
$object->supervise = $_POST['sup'];
if($_POST['date'] != null)$object->date = $_POST['date'];

if($_POST['prix'] != null)$object->prix = $_POST['prix'];
else {echo "prix" ; return;}
if($_POST['quantite'] != null)$object->quantite = $_POST['quantite'];
else {echo "quanti" ; return;}
$ind;
if($object->supervise > 0){
 $ind = $object->quantite;
 $object->quantite = 1;
}else{
 $ind = 1; 
}
echo $ind;
for($i = 0; $i < $ind ; $i++){
  echo "insert";
  insert($object);
}
echo "ok!";


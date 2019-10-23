<?php
require('../model/site.php');
require('../bdd.php');

if( !isset($_POST['nom']) || !isset($_POST['adresse']) || !isset($_POST['image'])  || !isset($_POST['description'])){
    
    echo "toute les variable ne sont pas instancié";
    return;
}

if( empty($_POST['nom']) || empty($_POST['adresse']) || empty($_POST['image']) || empty($_POST['description'])){
    
    echo "toute les variable ne sont pas instancié";
    return;
}

$object = new SITE();
$object->nom     = $_POST['nom'];
$object->adresse = $_POST['adresse'];
$object->image   = $_POST['image'];
$object->description = $_POST['description'];

insert($object);
echo "ok";
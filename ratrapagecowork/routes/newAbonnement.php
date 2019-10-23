<?php
require('../model/abonnement.php');
require('../bdd.php');
session_start();
/*if( !isset($_POST['prix']) || !isset($_POST['id_statut']) || !isset($_POST['id_site'])  || !isset($_POST['date_debut']) || !isset($_POST['date_fin'])){
    
    echo "toute les variable ne sont pas instancié";
    return;
}

if(empty($_POST['prix']) || empty($_POST['id_statut']) || empty($_POST['id_site'])  || empty($_POST['date_debut']) || empty($_POST['date_fin'])){
    
    echo "toute les variable ne sont pas instancié";
    return;
}

$abo = new ABONNEMENT();
$abo->prix = $_POST['prix'];
$abo->id_statut = $_POST['id_statut'];
$abo->id_site = $_POST['id_site'];
$abo->date_debut = $_POST['date_debut'];
$abo->date_fin = $_POST['date_fin'];
if(isset( $_POST['id_extra']) && !empty($_POST['id_extra']))$abo->id_extra = $_POST['id_extra'];
insert($abo);
echo "ok ";*/

$_POST['id_site'] = $_SESSION['site'];
$_POST['id_client'] = $_SESSION['id'];
$_POST['prix'] =10;
$_POST['id_extra'] = 1;
$_POST['date_debut'] = ' NOW() ';
$_POST['date_fin'] = ' NOW() + INTERVAL '.$_POST['duree'].' DAY ';
$obj= new ABONNEMENT();
$reflector = new ReflectionClass($obj);  
$properties = $reflector->getProperties();
foreach($properties as $propertie){
     $p = $propertie->getName();
    if($p != id){
        if(!isset($_POST[$p]) || empty($_POST[$p])){
            echo "variable non instancié : ".$p;
            return ;
        }
        $obj->$p = $_POST[$p]; 
    }
}

insert($obj);
echo "ok";

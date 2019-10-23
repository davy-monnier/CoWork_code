<?php

session_start();
require('../model/objectreservable.php');
require('../model/site.php');
require('../model/type.php');
require('../bdd.php');

$id_site = $_SESSION['site'];
if($id_site == null)return "error";

$obj = new OBJECT_RESERVABLE();
$tabretour = array();

$obj = selectWithCondition($obj , " id_site = ".$id_site);

foreach($obj as $objet){
    
    $type = new TYPE();
    $type->id = $objet->id_type;
    $objet->id_type = selectById($type);
    
  
    $tabretour[]= $objet;
}
echo json_encode($tabretour);
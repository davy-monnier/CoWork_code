<?php
require('../model/objectreservable.php');
require('../model/objectadmin.php');
require('../model/client.php');
require('../bdd.php');
$id_obj = $_POST['id_obj'];


$obj = new OBJECT_RESERVABLE();
$obj->id = $id_obj;
$obj = selectById($obj);
if($obj != null){
    $obj->client_possession = -1;
    $obj->quantite = 1;
    update($obj);
}
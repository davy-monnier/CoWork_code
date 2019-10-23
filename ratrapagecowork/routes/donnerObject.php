<?php


require('../model/objectreservable.php');
require('../model/objectadmin.php');
require('../model/client.php');
require('../bdd.php');
$id_obj = $_POST['id_obj'];
$id_clt = $_POST['id_clt'];

$obj = new OBJECT_RESERVABLE();
$obj->id = $id_obj;
$obj = selectById($obj);
if($obj != null){
    $obj->client_possession = $id_clt;
    update($obj);
}

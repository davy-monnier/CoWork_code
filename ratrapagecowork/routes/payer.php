<?php
session_start();
require('../bdd.php');
require('../model/client.php');
$id = $_POST['id'];
if($id == null){
    echo"variable non instanciée.";
    return;
}
$client = new CLIENT();
$client->id = $id;
$client = selectById($client);
$client->dette = 0;
print_r($client);
update($client);
echo "ok";
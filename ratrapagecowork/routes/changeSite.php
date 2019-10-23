<?php
session_start();
require('../bdd.php');
require('../model/client.php');

$site = $_POST['site'];
if($site == null || empty($site)){
    echo "erreur";
    return;
}
$_SESSION['site']=$site;
$user = new CLIENT();
$user->id = $_SESSION['id'];
$user = selectById($user);
$user->id_site = $site;
update($user);
echo json_encode($user);


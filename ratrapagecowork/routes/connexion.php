<?php
session_start();
require("../bdd.php");
require("../model/client.php");

if( !isset($_POST['email']) && !isset($_POST['password']) ){
     
    return;
}
if(empty( $_POST['email']) && empty($_POST['password'])){
    echo "empty";
    return;
}
   
function random($car) {
    $string = "";
    $chaine = "abcdefghijklmnpqrstuvwxy";
    srand((double)microtime()*1000000);
    for($i=0; $i<$car; $i++) {
        $string .= $chaine[rand()%strlen($chaine)];
    }
    return $string;
} 

$email    = $_POST['email'];
$password = $_POST['password'];


$user = new CLIENT();
$res = selectWithCondition($user , " email = ".type($email)." AND password = ".type($password));

if(empty($res)){
    echo"cette utilisatyeur n'existe pas";
    return ;
}

//$user->id = $res[0]->id;
$user = $res[0];
$chaine = $email.random(30);
$user->token = md5($chaine);
update($user);
$_SESSION['id'] = $user->id;
$_SESSION['email'] = $user->email;
$_SESSION['site'] = $user->id_site;
$_SESSION['dette'] = $user->dette;
$_SESSION['token'] = $user->token;
setcookie("cowork",md5($chaine),time()+500000000);

echo json_encode($user);
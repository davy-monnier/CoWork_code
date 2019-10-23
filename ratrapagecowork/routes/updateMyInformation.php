<?php

require("../bdd.php");
require("../model/client.php");

if(!isset($_POST['nom']) || !isset($_POST['prenom']) || !isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['confirmpassword'])  || !isset($_POST['id'])){
    
   echo "isset";
    return;
}
if(empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['confirmpassword']) || empty($_POST['confirmpassword'])){
    echo "empty";
    return;
}

$id    = $_POST['id'];
$nom    = $_POST['nom'];
$prenom = $_POST['prenom'];
$email  = $_POST['email'];
$password = $_POST['password'];


$user = new CLIENT();


$user->id = $id;
$user->nom = $nom;
$user->prenom = $prenom;
$user->email = $email;
$user->password = $password;

update($user);

$res = selectWithCondition($user , " email = ".type($email)." AND nom = ".type($nom)." AND  prenom = ".type($prenom)." AND  password = ".type($password));

if(empty($res)){
    echo"modification impossible";
    return ;
}
echo "update ok";
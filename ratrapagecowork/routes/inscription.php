<?php

require("../bdd.php");
require("../model/client.php");

if(!isset($_POST['nom']) || !isset($_POST['prenom'])|| !isset($_POST['email']) || !isset($_POST['password'])|| !isset($_POST['confirmpassword'])){
    
   echo"erreur";
    return;
}
if(empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['confirmpassword'])){
    echo "erreur";
    return;
}
   
$nom    = $_POST['nom'];
$prenom = $_POST['prenom'];
$email  = $_POST['email'];
$password = $_POST['password'];
$passwordc = $_POST['comfirmpassword'];
if($password != $passwordc){
  echo "erreur";
  return;
}


$user = new CLIENT();
$res = selectWithCondition($user , " email = ".type($email));

if(!empty($res)){
    echo"existe deja";
    return ;
}

$user->nom = $nom;
$user->prenom = $prenom;
$user->email = $email;
$user->password = $password;

insert($user);

$res = selectWithCondition($user , " email = ".type($email));

if(empty($res)){
    echo"ajout impossible";
    return ;
}
echo "ok";
<?php

if($_POST['id'] == null || $_POST['id'] == "" ||$_POST['email']== null || $_POST['email']== "" ||$_POST['site'] == null || $_POST['site'] == "" || $_POST['dette'] == null || $_POST['dette'] == "" || $_POST['token'] == null || $_POST['token'] == "" ){
    
     echo "erreur";   
}
$_SESSION['id'] = $_POST['id'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['site'] = $_POST['site'];
$_SESSION['dette'] =$_POST['dette'];
$_SESSION['token'] = $_POST['token'];
echo"ok"; 
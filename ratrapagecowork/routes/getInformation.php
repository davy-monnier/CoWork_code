<?php 

require('../model/client.php');
require('../bdd.php');

$obj= new CLIENT();



        if(!isset($_POST['id']) || empty($_POST['id'])){
            echo "variable non instancié";
            return ;
        }
        $obj->id = $_POST['id']; 


$objretour  = selectById($obj);

echo json_encode($objretour);
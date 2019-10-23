
<?php 

require('../model/abonnement.php');
require('../bdd.php');

$obj= new ABONNEMENT();        
$objretour  = selectWithCondition($obj , "1");
echo json_encode($objretour);

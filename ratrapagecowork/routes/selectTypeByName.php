
<?php 


require('../bdd.php');
require('../model/type.php');

if(!isset($_POST['nom'])   || empty($_POST['nom'])){
            echo "variable non instancié";
            return ;
}
$objName = $_POST['nom'];
$obj= new TYPE();



        
  
    

$objretour  = selectWithCondition($obj,"nom = '".$objName."'");

echo json_encode($objretour);

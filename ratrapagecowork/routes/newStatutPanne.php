
<?php 

require('../model/statut_panne.php');
require('../bdd.php');

$obj= new STATUT_PANNE();
$reflector = new ReflectionClass($obj);  
$properties = $reflector->getProperties();
foreach($properties as $propertie){
     $p = $properties->getName();
    if($p != id){
        if(!isset($_POST[$p]) || empty($_POST[$p])){
            echo "variable non instancié";
            return ;
        }
        $obj->$p = $_POST[$p]; 
    }
}

insert($obj);
echo "ok";



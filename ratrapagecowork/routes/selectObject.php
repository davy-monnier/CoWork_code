
<?php 

$files = glob('../model/*.php');

foreach ($files as $file) {
    require($file);   
}
require('../bdd.php');

if(!isset($_POST['id']) || empty($_POST['className']) || !isset($_POST['id']) || empty($_POST['className'])){
            echo "variable non instancié";
            return ;
}
$objName = $_POST['className'];
$obj= new $objName();



        
 $obj->id = $_POST['id']; 
    

$objretour  = selectById($obj);

echo json_encode($objretour);

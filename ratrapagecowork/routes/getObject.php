
<?php session_start();

require('../model/objectreservable.php');
require('../model/reservation.php');
require('../bdd.php');


function triObject($tab){
 	$tabRetour = array();
  
  foreach($tab as $obj){
    $add = true;
   	foreach($tabRetour as $objRetour){
     	if($obj->nom == $objRetour->nom){
          	if($obj->quantite == 1)$objRetour->id = $obj->id; // pour etre sur que l'objet reserver sera disponible.
         	$objRetour->quantite += $obj->quantite; 
          	$add = false;
        }
    }
    if($add) $tabRetour[] = $obj ; 
  }
  return $tabRetour;	
}



$site = $_POST['id_site'];
$obj= new OBJECT_RESERVABLE();
$obj2 = new RESERVATION();



        if(!isset($_POST['id_type']) || empty($_POST['id_type']) || $site == null){
            echo "variable non instancié site=".$site.' et type '.$_POST['id_type'];
            echo'printr';
          	print_r($_SESSION);
            return ;
        }
         
    


$objretour  = selectWithCondition($obj , "id_type = ".type($_POST['id_type'])." AND id_site = ".type($_POST['id_site']));
$objetRetire = selectWithCondition($obj2 , "( date_debut < ".type($_POST['datedebut'])." AND date_fin > ".type($_POST['datedebut']).") OR (date_debut < ".type($_POST['datefin'])." AND date_fin > ".type($_POST['datefin']).")");
foreach($objetRetire as $obje){
 	$id = $obje->id_object; 
  
    foreach($objretour as $obje2){
     	if ($obje2->id == $id && $obje2->quantite > 0) {
         	$obje2->quantite = $obje2->quantite -1;
        }
    }
}
$objretour = triObject($objretour);

echo json_encode($objretour);

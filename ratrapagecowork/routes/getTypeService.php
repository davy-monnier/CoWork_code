<?php 

session_start();
$id_site = $_SESSION['site'];
require('../bdd.php');
$files = glob('../model/*.php');
foreach ($files as $file) {
    require($file);   
}



if(!isset($_POST['id_abo']) || empty($_POST['id_abo']) ){
    echo "variable non instancié";
    return ;
}


$id_abo     = $_POST['id_abo'];
if($id_abo == -1 ){
    echo "vous n'avez pas d'abonnement";
    return;
}

$obj        = new ABONNEMENT();
$obj->id    = $id_abo;
$abonnement = selectById($obj);


$statut     = new STATUT();
$statut->id = $abonnement->id_statut;
$myStatut   = selectById($statut);

if($abonnement == null)return;


$droit_abo  = new DROIT_RESERVATION();
$droits      = selectWithCondition($droit_abo , " statut_level = ".type($myStatut->level)." AND id_site = ".type($id_site));

$tab;
$i = 0;
foreach($droits as $droit){
    $type = new TYPE();
    $type->id = $droit->id_type;
    $tab[$i++] = selectById($type);
}

echo json_encode($tab);




         
    


//$objretour  = selectWithCondition($obj , "id_type = ".type($_POST['id_type'])." AND id_site = ".type($_POST['id_site']));

//echo json_encode($objretour);
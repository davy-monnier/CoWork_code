
<?php session_start();

require('../model/objectreservable.php');
require('../model/reservation.php');
require('../bdd.php');
$id_obj = $_POST['id_object'];
$date= $_POST['date'];
if($date == null || $id_obj == null ){
    echo "erreur";
    return;
}
$reservation = new RESERVATION();
$reservations = selectWithCondition($reservation,"id_object = ".$id_obj." AND date_debut =".type($date));

//pour chaque reservation mettre retour a 1 qui signifie que l'objet est commander.

foreach($reservations as $res){
    
    $res->retour = 1;
    update($res);
    //evoyer email;
}
echo "ok";

<?php 
session_start();

$id_site = $_SESSION['site'];
require('../model/incident.php');
require('../model/statut_panne.php');
require('../bdd.php');

$incident = new INCIDENT();
$incidents = selectWithCondition($incident,"id_admin = -1 AND termine = 0 AND id_site "+$id_site+" ORDER BY date DESC");
foreach($incidents as $incid){
    $statutPanne = new STATUT_PANNE();
    $statutPanne->id = $incid->id_type_panne;
    $stat = selectById($statutPanne); 
    $incid->id_type_panne = $stat;
}
echo json_encode($incidents);
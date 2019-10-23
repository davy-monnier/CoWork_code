<?php
require('../model/extra.php');
require('../bdd.php');

if( !isset($_POST['max']) || !isset($_POST['tarif_base']) || !isset($_POST['tarif_sup'])  || !isset($_POST['temps_base']) || !isset($_POST['temps_sup'])){
    
    echo "toute les variable ne sont pas instancié";
    return;
}

if(empty($_POST['max']) || empty($_POST['tarif_base']) || empty($_POST['tarif_sup'])  || empty($_POST['temps_base']) || empty($_POST['temps_sup'])){
    
    echo "toute les variable ne sont pas instancié";
    return;
}

$extra = new EXTRA();
$extra->max 	   = $_POST['max'];
$extra->tarif_base = $_POST['tarif_base'];
$extra->tarif_sup  = $_POST['tarif_sup'];
$extra->temps_base = $_POST['temps_base'];
$extra->temps_sup  = $_POST['temps_sup'];

insert($extra);
echo "ok ";
<?php

require('../bdd.php');
require('../model/statut_panne.php');

$typePanne = new STATUT_PANNE();
$typePanne = selectWithCondition($typePanne,"1");
echo json_encode($typePanne);

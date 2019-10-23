<?php
session_start();
require('../bdd.php');
require('../model/site.php');


$site = new SITE();
$sites = selectWithCondition($site,"1");
echo json_encode($sites);
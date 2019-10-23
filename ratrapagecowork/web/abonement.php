<?php
session_start();
$_SESSION["cowork_statut_level"] = 3;
$_SESSION["site"] = 2;
$_SESSION["id"] = 1;
include('corptop.php');

echo "<script src='script/abonnementlist.js'></script>";

include('corpbot.php');
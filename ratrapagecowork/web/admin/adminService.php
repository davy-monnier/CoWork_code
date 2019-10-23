<?php
session_start();
$_SESSION['site']=2;
include('corptop.php');
echo "<h3 >Gestion des services</h3>";
echo '<br><table id="tb">

    
</table><button onclick="showForm()" class="btn btn-warning">Nouveau</button>';
echo "<div id='formnew' class='hide'>";
include('nouveauService.php');
echo "</div>";
echo "<script src='adminService.js'></script>";

include('corpbot.php');
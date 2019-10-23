<?php
session_start();
$_SESSION['site']=2;
include('corptop.php');

echo '<table id="tb">
   
</table>';
echo "<script src='user.js'></script>";
include('corpbot.php');

<?php 

if($_POST['className'] == null)return "error";
if($_POST['className'] != "ABONNEMENT") return "error class";
require('selectObject.php');


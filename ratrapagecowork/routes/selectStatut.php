
<?php 

if($_POST['className'] == null)return "error";
if($_POST['className'] != "STATUT") return "error class";
require('selectObject.php');


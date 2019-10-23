<?php
session_start();
$_SESSION['site']=2;
include('corptop.php');

echo '<div  id="tableau">"<h3><b>Gestion des commandes</b></h3><br>  
	<table id="tb">

    
	</table>
    
</div>';




echo "<script src='commande.js'></script>
";
include('corpbot.php');
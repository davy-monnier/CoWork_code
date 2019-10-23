<?php
session_start();
$_SESSION['site']=2;
include('corptop.php');

echo '<div  id="tableau">"<h3><b>Gestion du stock</b></h3><br>  
	<table id="tb">

    
	</table>
    <button class="btn btn-warning" onclick="showForm()">Nouvel objet</button>
</div>';




echo"<div style=\"display : none\" id='addpage'>";
include('nouveauObject.php');
echo"</div>";
echo "<script src='stockObject.js'></script>
";
include('corpbot.php');
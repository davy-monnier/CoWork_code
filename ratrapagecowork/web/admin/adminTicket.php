<?php
session_start();
$_SESSION['site']=2;
include('corptop.php');

echo '<div  id="tableau">"<h3><b>Gestion du stock</b></h3><br>  
	<table id="tb">

    
	</table>
   
</div>
<script src="adminTicket.js"></script>';
include('corpbot.php');
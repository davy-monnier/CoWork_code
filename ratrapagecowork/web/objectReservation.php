<?php

session_start();
include('corptop.php');

echo '<div id="site">'.$_SESSION['site'].'</div>
	 <div id="id_c">'.$_SESSION['id'].'</div>
     <div id="id_t">'.$_POST['id_type'].'</div>
<script> 
	document.getElementById("site").style.visibility = "hidden";
	document.getElementById("id_c").style.visibility = "hidden";
    document.getElementById("id_t").style.visibility = "hidden";
</script>
Du:<input value=""  type="text" id="datepicker">
	  <br><br>Au:<input  type="text" id="datepicker2">';

echo '<br><br><button class="btn btn-warning" onclick="show()">Rechercher</button><br><br>';
if($_POST['evenement'] != null);
else echo '<script src ="script/getObject.js"></script>';
include('corpbot.php');
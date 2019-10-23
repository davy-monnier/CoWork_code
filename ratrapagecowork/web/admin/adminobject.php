<?php
session_start();
$_SESSION['site']=2;
include('corptop.php');
$email_s ="";
if(isset($_GET['email_s'])&&!empty($_GET['email_s']))$email_s =$_GET['email_s'];
echo "<div id='email_s' >".$email_s."</div>";

echo '
<div id="tbcontainer" >
	<table id="tb">

    
	</table>
</div>    ';
echo'
<div class="hide" id="cali">
	<h2> Planning <span id="nomobj"></span></h2>
	<div id="calendrier"></div>
    <button onclick="showTab()" class="btn btn-warning">ok</button>
</div>';

echo "<script src='adminobject.js'></script>";

include('corpbot.php');
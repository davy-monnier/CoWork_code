<?php
session_start();
include('corptop.php');
echo '<div id="site">'.$_SESSION['site'].'</div>
<script> document.getElementById("site").style.visibility = "hidden"; </script>';
echo "<script src='script/servicelist.js'></script>";
include('corpbot.php');
<?php

echo '
<h3><b>Nouveau service</b></h3>
<small class="text-muted"><p><i>Sur cette page, vous pouvez créer un nouveau service pour votre site.</i></p></small>
<form method="post" enctype="multipart/form-data">
    <div class="input-group mb-3">
  		<div class="input-group-prepend">
    		<span style = "width: 100px" class="input-group-text" id="inputGroup-sizing-default">Nom</span>
  		</div>
    	<input class="form-control" aria-label="Default" aria-describedby="nom de l\'objet" name ="nom" type="text" ><br><br>
    </div>
   <div class="input-group mb-3">
  		<div class="input-group-prepend">
    		<span style = "width: 100px" class="input-group-text" id="inputGroup-sizing-default">Description</span>
  		</div>
    	<input class="form-control" aria-label="Default" aria-describedby="Description de l objet" name="des" type="text" ><br><br>
    </div>
    <div class="input-group mb-3">
  		<div class="input-group-prepend">
    		<span style = "width: 100px" class="input-group-text" id="inputGroup-sizing-default">Level</span>
  		</div>
    	<input class="form-control" aria-label="Default" aria-describedby="niveau abonnement autorisé" name ="level" type="text" ><br><br>
    </div>
    <div class="custom-file">
    	<label class="custom-file-label" for="test">Choisir une image </label>
    	<input name="test" accept="image/png, image/jpeg" class="custom-file-input" id="test" type="file" >
    </div>
    <br><br>
   	<input class="btn btn-warning m10"  type="submit" > <button class="btn btn-warning m10 "onclick="stoppop()">Anuuler</button></form>

 
    
  
';

 if(!empty($_FILES) && !empty($_POST['nom'])&& !empty($_POST['des'])&& !empty($_POST['level'])){
    echo'<script>
   
   
   $.post("[URL_API]/routes/newType.php",{nom:"'.$_POST['nom'].'" , image:"'.$_FILES["test"]["name"].'" , description:"'.$_POST['des'].'",statut_level:'.$_POST['level'].'},function(data){
        	alert(data);
        });
   		 </script>
   ';  
   require('uploadFile.php');
                 
                    }
//echo "<script src='script/servicelist.js'></script>";

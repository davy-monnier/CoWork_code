<?php


echo '
<h3><b>Nouvel object</b></h3>
<small class="text-muted"><p><i>Sur cette page, vous pouvez créer un nouvel objet pour un service de votre site.</i></p></small>
<form action="" method="post" enctype="multipart/form-data">
<div class="input-group " style = "margin-bottom: 0px">
	<div class="input-group-prepend">
    	<label style = "width: 100px" class="input-group-text" for="typeo">Type</label>
        
  	</div>
  	<select id="typeo" name="typeo"  class="custom-select in" >
    	<option value="1" >supervisé </option>
    	<option value="0" >non supervisé </option>
    	<option value="-2" >sur commande </option>
    	<option value="-1" >événement </option>
  	</select>
   
</div>
<small  id="emailHelp" class="form-text text-muted mb-3"> (Veuillez séléctionner le type d\'objet)</small>
  
    <div class="input-group mb-3">
  		<div class="input-group-prepend">
    		<span style = "width: 100px" class="input-group-text" id="inputGroup-sizing-default">Nom</span>
  		</div>
    	<input class="form-control in" id="nom" aria-label="Default" aria-describedby="nom de l\'objet" name ="nom" type="text" ><br><br>
    </div>
   <div class="input-group mb-3">
  		<div class="input-group-prepend">
    		<span style = "width: 100px" class="input-group-text" id="inputGroup-sizing-default">Description</span>
  		</div>
    	<TEXTAREA id="desc" class="form-control in" aria-label="Default" aria-describedby="Description de l objet" name="des"  ></TEXTAREA><br><br>
    </div>
    <div id="servactive" class="input-group mb-3">
  <div class="input-group-prepend">
    <label style = "width: 100px" class="input-group-text" for="options">Service</label>
  </div>
  <select name="serv" id="options" class="custom-select in" >
    
  </select>
</div>
<div id="evenactive">
    <div class="input-group mb-3 date" id="datecontainer">
  		<div class="input-group-prepend">
    		<span style = "width: 100px" class="input-group-text" id="inputGroup-sizing-default">Date</span>
  		</div>
    	<input  id="dateeven"  class="form-control in" aria-label="Default" aria-describedby="Date" name ="date" type="text" ><br><br>
    </div>
  </div>
     <div id="quant" class="input-group mb-3">
  		<div class="input-group-prepend">
    		<span style = "width: 100px" class="input-group-text" id="inputGroup-sizing-default">Quantité</span>
  		</div>
    	<input id ="quanti" class="form-control in" aria-label="Default" aria-describedby="Quantité du produit" name ="quant" type="number" ><br><br>
    </div>
   <div  class="input-group mb-3">
  		<div class="input-group-prepend">
    		<span style = "width: 100px" class="input-group-text" >Prix (€)</span>
  		</div>
    	<input id ="prix" class="form-control in" aria-label="Default" aria-describedby="Quantité du produit" name ="quant" type="number" ><br><br>
    </div>
    
    <div class="custom-file">
    	<label id="imagelab" class="custom-file-label" for="test">Choisir une image </label>
    	<input name="test" accept="image/png, image/jpeg" class="custom-file-input in" id="test" type="file" >
    </div>
    <br><br>
    <div id="buttonvalide">
   		<button id="btv" class="btn btn-secondary" >valider</button><button class="btn btn-danger" onclick="stopform()">annuler</button>
    </div>
</form >
<script>$("#datecontainer").datetimepicker();

</script>
<script src="newObject.js"></script>
 
    
  
';

 if(!empty($_FILES)){
   
   require('uploadFile.php');
                 
}

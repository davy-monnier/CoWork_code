<?php
include('corptop.php');

echo '
<h3><b>Nouveau ticket incident</b></h3>
<small class="text-muted"><p><i>Sur cette page, vous pouvez créer un ticket incident.</i></p></small>

  
 
    <div class="input-group mb-3">
        <div class="input-group-prepend ">
            <label style = "width: 100px" class="input-group-text" for="options">Type</label>
        </div>
        <select id="options" class="custom-select in" >
    
        </select>
    </div> 
    <div class="input-group mb-3">
  		<div class="input-group-prepend">
    		<span style = "width: 100px" class="input-group-text" id="inputGroup-sizing-default">Description</span>
  		</div>
    	<input class="form-control in" aria-label="Default" aria-describedby="id de l objet" name="des" id="idobje" type="text" ><br><br>
    </div>
      <div class="input-group mb-3">
  		<div class="input-group-prepend">
    		<span style = "width: 100px" class="input-group-text" id="inputGroup-sizing-default">Description</span>
  		</div>
    	<textarea class="form-control in" aria-label="Default" aria-describedby="Description de l objet" name="des" id="des" type="text" ></textarea><br><br>
    </div>
    <br><br>
   <div id="boutons">	<button  class="btn btn-success">Créer</button><button  class="btn btn-danger">Annuler</button></div>
<script src="script/ticket.js"></script>
    
  
';

include('corpbot.php');

//creation liste deroulante type
function insertType(){
    $.get("[URL_API]/routes/getType.php",function(data){
      
        var html ="";
        var types = JSON.parse(data);
        for( var ind in types ){
            html += "<option value='"+types[ind].id+"'>"+types[ind].nom+"</option>";
        }
        $("#options").html(html);
    });
}

//appel la route pour creer un objet
function create(){
  	var nom = $('#nom').val();
  	var supervise= $('#typeo').val();
  	var description = $('#desc').val();
  	var type = $('#options').val();
  	var date = $('#dateeven').val();
  	var prix = $('#prix').val();
  	var quantite = $('#quanti').val();
  	var img = $('#test').val().split("\\");
  	img = img[img.length-1];
 	if($('#typeo').val() == -1){
      type = -1;
    }
  	else if( $('#typeo').val() == -2){
      supervise  = 0;
      quantite = -1;
      date = null;
    }else{
      date = null;
    }
    var params = {nom:nom,sup:supervise,description:description,id_type:type ,date:date,prix:prix,quantite:quantite,image:img};
  	$.post("[URL_API]/routes/newObject.php",params,function( data ){   	
      	alert("data"+data);
      	$('#buttonvalide').html("<button id='btv' class='btn btn-warning' type='submit'>valider</button>");
    	$('#btv').get(0).click();
    });
  	
}
//appel la route pour update l'objet
function update(id){
  	var nom = $('#nom').val();
  	var supervise= $('#typeo').val();
  	var description = $('#desc').val();
  	var type = $('#options').val();
  	var date = $('#dateeven').val();
  	var prix = $('#prix').val();
  	var quantite = $('#quanti').val();
  	var img = $('#test').val().split("\\");
  	img = img[img.length-1];
 	if($('#typeo').val() == -1){
      type = -1;
    }
  	else if( $('#typeo').val() == -2){
      supervise  = 0;
      quantite = -1;
      date = null;
    }else{
      date = null;
    }
    var params = {id:id,nom:nom,sup:supervise,description:description,id_type:type ,date:date,prix:prix,quantite:quantite,image:img};
  	$.post("[URL_API]/routes/updateObject.php",params,function( data ){   	
      	if(data == "erreur")alert("La modification a échoué");
      	$("h3").text("Nouvel objet");
      	try{
   			normal();
		} catch(erreur){
    
		}
    });
}
function stopform(){
  ("h3").text("Nouvel objet");
      	try{
   			normal();
		} catch(erreur){
    
		}
}
//valide les inputs pour pouvoir creer l'objet
function testinput(){
  	var nom = $('#nom').val();
  	var supervise= $('#typeo').val();
  	var description = $('#desc').val();
  	var type = $('#options').val();
  	var date = $('#dateeven').val();
  	var prix = $('#prix').val();
  	var quantite = $('#quanti').val();
  	var img = $('#test').val();
 	if($('#typeo').val() == -1){
      
      if( nom == "" || supervise == "" || description == "" || date == "" || prix == "" || quantite == "" || img == "" ) $('#buttonvalide').html("<button id='btv' class='btn btn-secondary' >valider</button><button class='btn btn-danger' onclick='stopform()'>annuler</button>");
      else $('#buttonvalide').html("<button id='btv' class='btn btn-warning' onclick='create()'>valider</button><button class='btn btn-danger' onclick='stopform()'>annuler</button>");
    }
  	else if( $('#typeo').val() == -2){
     
      if( nom == "" || supervise == "" || description == ""  || prix == "" ||  img == "" )  $('#buttonvalide').html("<button id='btv' class='btn btn-secondary' >valider</button><button class='btn btn-danger' onclick='stopform()'>annuler</button>");
       else $('#buttonvalide').html("<button  id='btv' class='btn btn-warning' onclick='create()'>valider</button><button class='btn btn-danger' onclick='stopform()'>annuler</button>");
    }else{
      
      if( nom == "" || supervise == "" || description == "" ||  prix == "" || quantite == "" || img == "" )  $('#buttonvalide').html("<button id='btv' class='btn btn-secondary' >valider</button><button class='btn btn-danger' onclick='stopform()'>annuler</button>");
      else $('#buttonvalide').html("<button id='btv' class='btn btn-warning' onclick='create()'>valider</button><button class='btn btn-danger' onclick='stopform()'>annuler</button>");
    }
  	if($("#test").val() != ""){
      	var im = $("#test").val().split("\\");
		$("#imagelab").text(im[im.length -1]);
    }
}

//valide les inputs pour pouvoir update l'objet
function testInputForUpdate(id){
  testinput();
  
  if($('#btv').attr("class")=='btn btn-warning'){
    	$('#buttonvalide').html("<button class='btn btn-warning' onclick='update("+id+")'>modifier</button>");
  }else{
    	$('#buttonvalide').html("<button type='button' class='btn btn-secondary' onclick=''>modifier</button>");
  }
}

//passer en mode update
//si volonter d'update initialisation des inputs avec les champs actuel
function prepare(id,nom,supervise,description,type,date,prix,img,quantite){
   $('.in').change(function(){testInputForUpdate(id);});
  	$("h3").text("Modifier objet");
  	$('#nom').val(nom);
  	$('#typeo').val(supervise);
  	$('#desc').val(description);
  	$('#options').val(type);
  	$('#dateeven').val(date);
  	$('#prix').val(prix);
  	$('#quanti').val(quantite);
  	$('#test').val(img);
  	//$('.in').change(testInputForUpdate);
  	testInputForUpdate(id);
}

//initialisation 
insertType();
$('.in').change(testinput);
$('#evenactive').hide();

//etabli les inputs visible selon le type d'objet
$('#typeo').change(function(){
	if($('#typeo').val() == -1){
      $('#servactive').slideUp();
      $('#evenactive').slideDown();
    }else {
      $('#evenactive').slideUp();
      $('#servactive').slideDown();
      if($('#typeo').val() == -2){
       	$('#quant').slideUp(); 
      }else{
        $('#quant').slideDown(); 
      }
    }
});
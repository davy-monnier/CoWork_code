//montrer formulaire nouveau
function showForm(){
 var html = $('#formnew').html();
  pop(html);
}

//retourne html a injecter dans la pop up
function insertActive(nom , id){
 	var html= "<h2>"+nom+"</h2>"
    +"Pour activer ce service, veuillez saisir l'abonement qui y aura acces"
    +"<br><b>Attention!</b> les abonnements du même niveau ou niveaux supérieurs, y auront également accés."
    +"<br><select id='abolist'></select>"
    +"<br><button onclick='active("+id+",\""+nom+"\")' class='btn btn-warning'>valider</button><button onclick='stoppop()'class='btn btn-danger m10'>annuler</button>";
  	pop(html);
  	insertabo();
}
function insertDesactive(nom , id){
 	 	var html= "<h2>"+nom+"</h2>"
    +"Voulez-vous désactiver le sevice "+nom+"?"
    +"<br><b>Attention!</b> les réservations liés à ce service seront suprimées, les utilisateurs seront prévenus par email."
    +"<br>De plus, si ce service est payant, celui-ci sera remboursé (déduit de la dette client)."
    +"<br><button onclick='desactive("+id+",\""+nom+"\")' class='btn btn-warning'>valider</button><button onclick='stoppop()'class='btn btn-danger m10'>annuler</button>";
  	pop(html);
}

//insertion options
function insertabo(){
  $.get("[URL_API]/routes/getAbo.php",function(data){
    alert(data);
  	var abos = JSON.parse(data);
    var options ="";
    for(var abo in abos){
     	 options += "<option value="+abos[abo].id+">"+abos[abo].nom+"</option>";
    }
    $('#abolist').html(options);
  });
}

function active(id,nom){
 try{
  $.post("[URL_API]/routes/activeService.php",{service:id,level:$("#abolist").val()},function(data){
     if(data != "erreur"){
  		$('#bt'+id).html('<button onclick="insertDesactive(\''+nom+'\','+id+')" class="btn btn-success">Désactiver</button>');
    	$('#level'+id).text(data);
     }else{
      	alert("une erreur est survenu veuillez créer un ticket incident."); 
     }
    stoppop();
  });
 }catch(erreur){
   alert("une erreur est survenu veuillez créer un ticket incident."); 
   stoppop();
 }
}
function desactive(id,nom){
  try{
  $.post("[URL_API]/routes/desactiveService.php",{service:id},function(data){
   
     if(data != "erreur"){
  		$('#bt'+id).html('<button onclick="insertActive(\''+nom+'\','+id+')" class="btn btn-warning">Activer</button>');
    	$('#level'+id).text(data);
     }else{
      	alert("une erreur est survenu veuillez créer un ticket incident."); 
     }
    stoppop();
  });
 }catch(erreur){
   alert("une erreur est survenu veuillez créer un ticket incident."); 
   stoppop();
 }
}
function echoTab(obj ){
	
   	var bt = "";
  	if(obj.description != "-1"){
     	bt =  '<button onclick="insertDesactive(\''+obj.nom+'\','+obj.id+')" class="btn btn-success">Désactiver</button>';
    }else{
      	bt =  '<button onclick="insertActive(\''+obj.nom+'\','+obj.id+')" class="btn btn-warning">Activer</button>';
    }
 	return  ' <tr><td>'+obj.nom+'</td><td id="level'+obj.id+'">'+obj.description+'</td><td id="bt'+obj.id+'" >'+bt+'</td><</tr>';
}
 function deleterow(id){
  
 }


$.get("[URL_API]/routes/getType.php",function(data){
  	
    var string ='<thead><tr><th >Nom</th><th >Level</th><th>Activer</th></tr></thead><tbody> ';
    
    var objs = JSON.parse(data);
    for(client in objs){
        string += echoTab(objs[client]);
    }
    string += "</tbody>";
    $("#tb").html(string);
	var table =  $("#tb").DataTable({    
     language: {
        processing:     "Traitement en cours...",
        search:         "Rechercher&nbsp;:",
        lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
        info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
        infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
        infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        infoPostFix:    "",
        loadingRecords: "Chargement en cours...",
        zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
        emptyTable:     "Aucune donnée disponible dans le tableau",
        paginate: {
            first:      "Premier",
            previous:   "Pr&eacute;c&eacute;dent",
            next:       "Suivant",
            last:       "Dernier"
        },
        aria: {
            sortAscending:  ": activer pour trier la colonne par ordre croissant",
            sortDescending: ": activer pour trier la colonne par ordre décroissant"
        }
    }});
 $('#tb').on( 'click', 'tbody tr  .delete', function () {
    $('#tb').DataTable().row( $(this).parents('tr') ).remove().draw();
} );
  if($('#email_s').text() != "" || $('#email_s').text() != null){
   		table.search($('#email_s').text()).draw(); 
  }
});
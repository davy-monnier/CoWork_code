function donner(id_obj,id_client){
stoppop();
$.post("[URL_API]/routes/donnerObject.php",{id_obj: id_obj ,id_clt: id_client},function(data){alert(data);});
}
function reparer(id_obj){
stoppop();
$.post("[URL_API]/routes/reparationObject.php",{id_obj: id_obj },function(data){alert(data);});
}
function recuperer(id_obj){
stoppop();
$.post("[URL_API]/routes/recuperationObject.php",{id_obj: id_obj },function(data){alert(data);});
}
function donnerValidate(id_obj,id_client){
    popValidate("Confier materiel","Voulez vous vraiment donner l'objet d'id: "+id_obj,"donner("+id_obj+","+id_client+")");
}
function reparerValidate(id_obj){
  popValidate("Confier materiel","Voulez vous vraiment mettre l'objet d'id: "+id_obj+" à réparer?","reparer("+id_obj+")");
}
function recupererValidate(id_obj){
  popValidate("Confier materiel","Voulez vous vraiment mettre l'objet d'id: "+id_obj+" dans le stock?","recuperer("+id_obj+")");
}
function showCalendar(id,nom=""){
  $('#tbcontainer').slideUp(300,function (){
 	$('#cali').show();
    $('#nomobj').text(nom);
	$.post('[URL_API]/routes/getEventsObject.php',{id:id},function(data){
      alert(data);
		var eventsJson = JSON.parse(data);
      	var calendarEl =$('#calendrier').html(" ");
      	//pop("<div id='calen'></div>");
      	var calendarEl =$('#calendrier')[0] ;
		var calendar = new FullCalendar.Calendar(calendarEl, {
				lang: 'fr',
				plugins: ['dayGrid', 'timeGrid', 'list','interaction','moment'],
				events:eventsJson,
				eventClick: function(info) { 	
    					var start = moment(info.event.start).format('DD-MM-YYYY HH:mm');
        				var end = moment(info.event.end).format('DD-MM-YYYY HH:mm');
    					var message = '<h3>'+info.event.title+'</h3>informations sur votre résevation:<br> Début: '+start+'<br> Fin: '+end+'<br><button onclick=\'stoppop()\' class=\'btn btn-warning ml10\'> ok</button><button onclick=\'sup()\' class=\'btn btn-danger ml10\'>suprimer</button>';                 
    					//info.event.id;
        				pop(message);
   
    			}
		});

		calendar.render();
      	
      	//$('#cal').html("");
	});
  });
}
function showTab(){
  $('#cali').slideUp(function(){
  		$('#tbcontainer').fadeIn();
  });
}
function transformButton(sup,val , reserv ,id_obj,id_client){
  	var bt_return = "";
 	if(val == "donner"){
  	if(reserv == "non"){
      bt_return = '<button class="btn btn-secondary" >'+val+'</button>';  
    }
   else bt_return = '<button class="btn btn-warning" onclick="donnerValidate('+id_obj+','+id_client+');">'+val+'</button>';  
   
 }else bt_return = '<button class="btn btn-warning"> '+val+'</button>';  
 if(val == "")bt_return = '<button class="btn btn-secondary" >donner</button>'; 
 if(sup == "non")return "";
 return bt_return;
}

function echoTab(obj ){
	var sup = "non";
	var poss;
  	var reserv = "non";
   	var retour = "donner";
  	var repar = '<button class="btn btn-warning" onclick="reparerValidate('+obj.obj.id+')">réparation</button>';
 	if(obj.obj.supervise == 1)sup = "oui";
 	if(obj.obj.client_possession == -1)poss= "-";
    else if(obj.obj.client_possession == -2){
      poss= "réparation";
      retour = "";
      repar = '<button class="btn btn-success" onclick="recupererValidate('+obj.obj.id+')">retour stock</button>'
    }
    else{
      poss = obj.client.nom +" "+obj.client.prenom+"<br> "+obj.client.email;
      retour = "retour";
    }
   	var id_c = 0;
  	var id_o = obj.obj.id;
    if(obj.client_reserv != null) {
      	reserv = obj.client_reserv.email;
  		id_c = obj.client_reserv.id;
    }
  	retour = transformButton(sup,retour,reserv,id_o,id_c);
 	return  ' <tr><td>'+obj.obj.id+'</td><td>'+obj.obj.nom+'</td><td>'+sup+'</td><td>'+poss+'</td><td>'+reserv+'</td><td>'+retour+'</td><td>'+repar+'</td><td><button class="btn btn-info" onclick="showCalendar('+obj.obj.id+',\''+obj.obj.nom+' id: '+obj.obj.id+'\')">Planning</button></tr>';
}

$('#email_s').hide();
//showCalendar(0);
$('#cali').hide();
$.get("[URL_API]/routes/getObjectAdmin.php",function(data){
  	
    var string ='<thead><tr><th >Id</th><th >Nom</th><th >Supervisé</th><th >Détenteur</th><th >Reservé</th><th >Donner/Retour</th><th >Reparation</th><th>Planning</th></tr></thead><tbody > ';
    
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
 $('#tb').on( 'click', 'tbody tr .delete', function () {
    $('#tb').DataTable().row( $(this).parents('tr') ).remove().draw();
} );
  if($('#email_s').text() != "" || $('#email_s').text() != null){
   		table.search($('#email_s').text()).draw(); 
  }
});
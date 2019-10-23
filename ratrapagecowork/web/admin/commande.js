
function commander(id,date){
    $.post("[URL_API]/routes/commandeObject.php",{id_object:id, date:date},function(data){
        if(!data.includes("ok")){
            alert("impossible de passer la commande!");
          	alert(data);
            stoppop();
            return;
        }
        $("#btco"+id+date.split(" ")[0]).html('<button   class="btn btn-warning" >Réceptionner</button>');
        stoppop();
    });
}

function echoTab(obj ){
    
    var commander = '<div id="btco'+obj.id+obj.date.split(" ")[0]+'" ><button  class="btn btn-warning" onclick="commander('+obj.id+',\''+obj.date+'\')">Commander</button></div>';
    var suprimer = '<button class="btn btn-danger delete" >Suprimer</button>';
    var voir =  '<button class="btn btn-info" >Voir</button>';
    
    if(obj.supervise == 1) commander = '<div id="btco'+obj.id+obj.date.split(" ")[0]+'" ><button   class="btn btn-warning" >Réceptionner</button></div>';

 	return  ' <tr><td>'+obj.id+'</td><td>'+obj.nom+'</td><td>'+obj.date+'</td><td>'+obj.quantite+'</td><td>'+commander+'</td><td>'+suprimer+'</td><td>'+voir+'</td></tr>';
}


$.get("[URL_API]/routes/getCommande.php",function(data){
  	
    var string ='<thead><tr><th >Id</th><th >Nom</th><th >Date</th><th >Quantité</th><th >Commander</th><th >Suprimer</th><th >Voir client</th></thead><tbody > ';
    
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
function echoTab(obj ){

   	
 	return  ' <tr><td>'+obj.id_type_panne.nom+'</td><td>'+obj.description+'</td><td><button class="btn btn-warning">Activer</button></td><</tr>';
}



$.get("[URL_API]/routes/getPanne.php",function(data){
  	
    var string ='<thead><tr><th >Type</th><th >Description</th>><th>Récupérer</th></tr></thead><tbody > ';
    
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